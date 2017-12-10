#include "EmonLib.h"
#include <SPI.h>
#include <Ethernet.h>

EnergyMonitor emon1;
//Tensao da rede eletrica
int rede = 220;
 
//Pino do sensor SCT
int pino_sct = A2;

EthernetClient cliente;

void setup()
{
  Serial.begin(9600);
  //Pino, calibracao - Cur Const= Ratio/BurdenR. 2000/33 = 60
  emon1.current(pino_sct, 60.6);
}

void loop()
{
 delay(1000);
 double Irms = emon1.calcIrms(1480);
 int potencia = Irms * rede;
 Serial.print("A: ");
 Serial.println(Irms);
 Serial.print("W: ");
 Serial.println(potencia);
}
