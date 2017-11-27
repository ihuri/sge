#include "EmonLib.h"
#include <SPI.h>
#include <Ethernet.h>

//leds de Informação
//led verde - Dados enviados com sucesso
const int ledVerd = 9;
//led vermelho - erro ao enviar dados ao servidor 
const int ledVerm = 8;

EnergyMonitor emon1;
//Tensao da rede eletrica
int rede = 127;

//Pino do sensor SCT
int pino_sct = A1;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

byte ip[] = { 192, 168, 0, 5 };

byte servidor[] = { 192, 168, 0, 100 };

int vetPotencia[60];
int tempo = 0;
int tamanho = 60;

EthernetClient cliente;

void setup()
{
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  //Pino, calibracao - Cur Const= Ratio/BurdenR. 2000/33 = 60
  emon1.current(pino_sct, 60.6);

  // initialize digital pin LED_BUILTIN as an output.
    //saida do verde
  pinMode(ledVerd, OUTPUT);
  //saida do vermelho
 pinMode(ledVerm, OUTPUT);
}

void loop()
{

  delay(1000);
  tempo++;
  double Irms = emon1.calcIrms(1480);
  //os valores vem em float porem são variações muito pequenas por isso estou convertendo de float para int, sendo meio que um arrendondamento
  int potencia = Irms * rede;
 // Serial.println(potencia);
  vetPotencia[tempo] = potencia;
  //organizando o vetor com o Método de Inserção (Inserction Sort)
  int i, j, a, b, aux;
  for (a = 1; a > tempo; a++) {
    b = a;

    while ((b != 0) && (vetPotencia[b] > vetPotencia[b - 1])) {
      aux = vetPotencia[j];
      vetPotencia[b] = vetPotencia[b - 1];
      vetPotencia[b - 1] = aux;
      b--;
    }
  }
     Serial.print("Leitura - ");
     Serial.print(tempo);
     Serial.print(": ");
  for(int x = 0; x < tempo; x++){
     Serial.print(vetPotencia[x]);
     Serial.print(", ");
  }
  Serial.println(".");
  Serial.println("-----------------------");
  //digitalWrite(ledAma, HIGH);   // ligando o LED Amarelo para informar que a leitura iniciou
  if (tempo == tamanho) {
    Serial.println("-----------------------");
    //gerando a moda do conjunto de leituras de 1 minuto (60s)
  int i = 0, j = 0, moda = 0, cont = 0, maior = 0;      // auxiliares
    
    for (i = 0; i <= tamanho; i++) {
        for (j = i + 1; j < tamanho; j++) {
            if (vetPotencia[j] == vetPotencia[i]) {
                cont++;
            }
            else{  
      if(cont >= maior){
        maior = cont;
        moda = vetPotencia[i];
        cont = 0;
      }
      else{
        cont = 0;
      } 
    }
        }
    }
    Serial.println("a moda eh:");
    Serial.println(moda);
    Serial.println("-----------------------");
    //limpando as variaveis tempo e vetPotencia
       for (int i = 0; i == 60; i++) {
      vetPotencia[i] = 0;
    }

    //envio de informações para o servidor
    if (cliente.connect(servidor, 80))
    {
     digitalWrite(ledVerm, LOW);    // desliga o vermelho se foi enviado corretamente
    digitalWrite(ledVerd, HIGH);   // liga o LED verde para informar que a leitura foi enviado para o servidor
    Serial.println("Conectado");
      cliente.print("GET /programacao/salvar_dados.php?");
      cliente.print("irms=");
      cliente.print(Irms);
      cliente.print("&potencia=");
      cliente.print(moda);
      cliente.print("&tempo=");
      cliente.println(tempo);

      Serial.print("A=");
      Serial.println(Irms);
      Serial.print("Potencia=");
      Serial.println(Irms*rede);
      Serial.print("Segundos=");
      Serial.println(tempo);
      Serial.println("-----------------------");
      tempo = 0;
      cliente.stop();

    }
    else
    {
      // if you didn't get a connection to the server:
      Serial.println("Falha na conexao");
      tempo = 0;
      digitalWrite(ledVerd, LOW);    // desliga o LED verde para informar que deu erro no envio
      digitalWrite(ledVerm, HIGH);   // vermelho informando que teve falha no envio 
      
    }
  }

}


