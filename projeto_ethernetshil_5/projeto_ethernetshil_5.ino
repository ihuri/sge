#include "EmonLib.h"
#include <SPI.h>
#include <Ethernet.h>

//leds de Informações:
//led verde - Dados enviados com sucesso
const int ledVerd = 9;
//led vermelho - erro ao enviar dados ao servidor
const int ledVerm = 8;


EnergyMonitor emon1;
EnergyMonitor emon2;

//Tensao da rede eletrica - Energia padrão Nas tomadas e Lampadas
int rede = 116;

//Tensao da rede eletrica - Tomada Especial com tenção de 220
int rede2 = 220;

//Pino do sensor SCT porta analogica 1- Tomadas e Lampadas
int pino_sct = A1;

//Pino do sensor SCT porta analogica 2- Choveiro
int pino_sct2 = A2;

//configurações de rede
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

byte ip[] = { 192, 168, 1, 9 };

byte servidor[] = { 192, 168, 1, 10 };

//declarações de variaveis fixas
int vetPotencia[60];
int vetPotencia2[60];
int tempo = 0;
int tamanho = 60;

//criando um cliente para a conexão de rede
EthernetClient cliente;

void setup()
{
  Serial.begin(9600);

  //configração das informaçõesda placa de rede
  Ethernet.begin(mac, ip);

  //Pino, calibracao - Cur Const= Ratio/BurdenR. 2000/33 = 60 (SENSOR 1)
  emon1.current(pino_sct, 60.6);

  //Pino, calibracao - Cur Const= Ratio/BurdenR. 2000/33 = 60 (SENSOR 2)
  emon2.current(pino_sct2, 60.6);


  // initialize digital pin LED_BUILTIN as an output.
  //saida do verde
  pinMode(ledVerd, OUTPUT);
  //saida do vermelho
  pinMode(ledVerm, OUTPUT);

  //declarando funções
  void insertionSort(int arr[], int n);
  void printArray(int arr[], int n, int s);
  void printDados(double ir, int rd, double md, int s);
  int gerarModa(int arr[], int n, int s);
  int gerarMediana(int arr[], int t, int s);
  void cleanArray(int arr[], int n);
  void enviarDados(double ir, int md, int tp, double ir2, int md2,String pagina);
}

void loop()
{

  delay(1000);
  tempo++;

  //pegando a leitura do sensor 1
  double Irms = emon1.calcIrms(1480);

  //pegando a leitura do sensor 2
  double Irms2 = emon2.calcIrms(1480);

  //os valores vem em float porem são variações muito pequenas por isso estou convertendo de float para int, sendo meio que um arrendondamento
  int potencia = Irms * rede;
  int potencia2 = Irms2 * rede2;

  //a condição foi criada para retirar o valor do ruido do choveiro pois o mesmo não possui standby como os outro eletronicos que estão ná casa.
  int ruido = 32;
  if (potencia2 > ruido) {
    potencia = potencia + potencia2;
    vetPotencia2[tempo] = potencia2;
  }
  else{
    vetPotencia2[tempo]= ruido;
  }
  vetPotencia[tempo] = potencia;

  //organizando as leituras
  insertionSort(vetPotencia, tempo);

  //organizando as leituras
  insertionSort(vetPotencia2, tempo);

  if (tempo == tamanho) {
    int moda = gerarModa(vetPotencia, tamanho, 1);
    int mediana = gerarMediana(vetPotencia2, tamanho, 2);
    cleanArray(vetPotencia, tamanho);
    cleanArray(vetPotencia2, tamanho);
    printArray(vetPotencia, tempo, 1);
    printArray(vetPotencia2, tempo, 2);
    printDados(Irms, rede, moda, 1);
    printDados(Irms2, rede2, mediana, 2);
    enviarDados(Irms, moda, tempo, Irms2, mediana, "salvar_dados.php");
    tempo = 0;


  }

}

//função de ordenação de vetor Insertion Sort
void insertionSort(int arr[], int n)
{
  int i, key, j;
  for (i = 1; i < n; i++)
  {
    key = arr[i];
    j = i - 1;

    /* Move elements of arr[0..i-1], that are
       greater than key, to one position ahead
       of their current position */
    while (j >= 0 && arr[j] > key)
    {
      arr[j + 1] = arr[j];
      j = j - 1;
    }
    arr[j + 1] = key;
  }
}

//função para limpar dados do array
void cleanArray(int arr[], int n) {
  for (int i = 0; i == n; i++) {
    arr[i] = '/0';
  }
}

// função para imprimir vetor
void printArray(int arr[], int n, int s)
{
  int i;
  Serial.print(s);
  Serial.print("ª Leitura: ");
  Serial.print(n);
  Serial.print(" - ");
  for (i = 0; i < n; i++) {
    Serial.print(arr[i]);
    Serial.print(", ");
  }
  Serial.println(" ");
}

//função para imprimir os dados na porta serial
void printDados(double ir, int rd, double md, int s) {
    Serial.print("***__Sensor_");
    Serial.print(s);
    Serial.println("__***");
    Serial.print("Tensão: ");
    Serial.println(rd);
    Serial.print("Amperagem: ");
    Serial.println(ir);
    Serial.print("Potencia: ");
    Serial.println(ir * rd);
    Serial.println("***____FIM_____***\n\n"); 
}

//função para gerar a moda de um vetor
int gerarModa(int arr[], int n, int s) {
  int i = 0, j = 0, m = 0, cont = 0, maior = 0;      // auxiliares

  for (i = 0; i <= n; i++) {
    for (j = i + 1; j < n; j++) {
      if (arr[j] == arr[i]) {
        cont++;
      }
      else {
        if (cont >= maior) {
          maior = cont;
          m = arr[i];
          cont = 0;
        }
        else {
          cont = 0;
        }
      }
    }
  }
  Serial.print("***_Moda ");
  Serial.print(s);
  Serial.print(" :_");
  Serial.print(m);
  Serial.println("_***");
  return m;
}

//função responsavel por retonar a mediana de um vetor
int gerarMediana(int arr[], int t, int s)   
{
  int m;
  if(t % 2 == 0)
  {
    m = ((arr[(t / 2) - 1] + arr[(t / 2)]) / 2); 
  }
  else{
  m = arr[t /2 ];
}
  Serial.print("***_Mediana Sen -  ");
  Serial.print(s);
  Serial.print(" :_");
  Serial.print(m);
  Serial.println("_***");
}

//função para enviar dados para o servidor
void enviarDados(double ir, int md, int tp, double ir2, int md2,String pagina) {
  //envio de informações para o servidor
  if (cliente.connect(servidor, 80))
  {
    digitalWrite(ledVerm, LOW);    // desliga o vermelho se foi enviado corretamente
    digitalWrite(ledVerd, HIGH);   // liga o LED verde para informar que a leitura foi enviado para o servidor
    Serial.println("***_Conectado_***");
    cliente.print("GET /programacao/");
    cliente.print(pagina);
    cliente.print("?");
    cliente.print("irms=");
    cliente.print(ir);
    cliente.print("&potencia=");
    cliente.print(md);
    cliente.print("&tempo=");
    cliente.println(tp);
    cliente.print("&irms2=");
    cliente.print(ir2);
    cliente.print("&potencia2=");
    cliente.print(md2);
    cliente.stop();

  }
  else
  {
    //caso ocorra algum problema em estabelecer conexão ou enviar os dados apresentarar um erro e acenderar um led vermelho
    Serial.println("***_Falha_na_conexao_***");
    digitalWrite(ledVerd, LOW);    // desliga o LED verde para informar que deu erro no envio
    digitalWrite(ledVerm, HIGH);   // vermelho informando que teve falha no envio

  }
}

