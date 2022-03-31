# API WhatsApp PHP & VDM 

##### Contato
<a href="https://wa.me/5566996852025"> 
<img src="https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white" /> 
</a>
<a href="https://www.instagram.com/raphaelvserafim"> 
<img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white" /> 
</a>


## Instalando via composer 

```
composer require cachesistemas/whatsapp

```


## Exemplos de uso 


#####  VDM  
```php
 
use API\Container;
 
include_once 'vendor/autoload.php';


$container  = new Container(["url" => "sua-url", "token" => "seu-token"]);

echo $container->criar(3, 500); // ID e Memória  
echo $container->stop(3);
echo $container->start(3);
echo $container->deletar(3);

echo $container->lista();
 
```
######  RETORNO: CRIAR, STOP, START , DELETAR 
```json
 {"result":200,"message":"SUCCESS"}   
 
 {"result":400,"message":"TOKEN_INVALID"} 
```

######  RETORNO  LISTAR 
```json
 [{"codigo":"id-do-container","api":"3"}]
```



#####  WHATSAPP   

```php
 
use API\WhatsApp;
 
include_once 'vendor/autoload.php';

 
$whatsapp = new WhatsApp([
    "apikey"     => "sua-key",
    "session"    => "3",
    "token"      => "seu-token",
    "url_api"    => "sua-url-api",
    "wh_connect" => "sua-url-webhook",
    "wh_qrcode"  => "sua-url-webhook",
    "wh_status"  => "sua-url-webhook",
    "wh_message" => "sua-url-webhook"
]);

 
```

 ###### Atualizar Presença
```php
 echo $whatsapp->sendPresena(array("chatId" => 5566996852025, "state" => "c"));  // c = digitando, r = gravando, a = online, p = offline
 ```
 ######  Retorno 
```json
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "set-presence"
}
```


 ###### Enviar Mensagem de  Texto
```php
 echo $whatsapp->sendText(array("chatId" =>  5566996852025, "text" => "Oie"));
 ```
 ######  Retorno 
```json
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "text",
    "isMedia": false,
    "id": "BAE530A9BC0D61B0",
    "to": "556696852025",
    "content": "Oie",
    "isgroup": false,
    "timestamp": 1648730804
}
```


 ###### Enviar Foto
```php
echo $whatsapp->sendImagem(array("chatId" => 5566996852025, "text" => "CACHE SISTEMAS", "url" => "https://www.cachesistemas.com.br/assets/files/graphic3-min.png"));
 ```
 ######  Retorno 
```json
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "image",
    "isMedia": true,
    "id": "BAE5D450EF3F37FC",
    "to": "556696852025",
    "isgroup": false,
    "file": {
        "url": "https://mmg.whatsapp.net/d/f/AqRg-Gdy7xKwcQ91yQGmyz0h5jwop6bIvML9m7jKxnWV.enc",
        "caption": "CACHE SISTEMAS",
        "mimetype": "image/jpeg",
        "fileSha256": { "type": "Buffer", "data": [97, 164, 216, 121, 64, 85, 191, 136, 255, 172, 176, 241, 236, 56, 60, 236, 11, 13, 23, 122, 186, 16, 120, 22, 32, 110, 88, 59, 102, 13, 25, 18] },
        "fileLength": { "low": 63888, "high": 0, "unsigned": true },
        "height": 0,
        "width": 0,
        "mediaKey": { "type": "Buffer", "data": [115, 126, 230, 220, 180, 58, 248, 140, 127, 157, 145, 196, 200, 19, 82, 42, 240, 102, 170, 150, 246, 153, 31, 106, 61, 190, 64, 147, 123, 51, 251, 65] },
        "fileEncSha256": { "type": "Buffer", "data": [181, 251, 199, 212, 152, 22, 134, 23, 40, 189, 234, 241, 230, 171, 106, 9, 250, 71, 198, 14, 80, 203, 2, 192, 110, 13, 171, 20, 39, 189, 122, 123] },
        "directPath": "/v/t62.7118-24/32794752_772094980431391_3323090370317866999_n.enc?ccb=11-4&oh=01_AVxQlwjf4D_W5ORsvBk2IXAZysn1XE_6uLAy2djj_aZMow&oe=626C801A",
        "thumbnail": { "type": "Buffer", "data": [255, 216, 255, 219, 0, 67, 0, 16, 11, 12, 14, 12, 10, 16, 14, 13, 14, 18, 17, 16, 19, 24, 40, 26, 24, 22, 22, 24, 49, 35, 37, 29, 40, 58, 51, 61, 60, 57, 51, 56, 55, 64, 72, 92, 78, 64, 68, 87, 69, 55, 56, 80, 109, 81, 87, 95, 98, 103, 104, 103, 62, 77, 113, 121, 112, 100, 120, 92, 101, 103, 99, 255, 219, 0, 67, 1, 17, 18, 18, 24, 21, 24, 47, 26, 26, 47, 99, 66, 56, 66, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 255, 192, 0, 17, 8, 0, 32, 0, 32, 3, 1, 34, 0, 2, 17, 1, 3, 17, 1, 255, 196, 0, 24, 0, 0, 3, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 5, 6, 7, 3, 255, 196, 0, 43, 16, 0, 2, 1, 3, 3, 2, 4, 6, 3, 0, 0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 17, 0, 18, 33, 6, 49, 19, 34, 113, 129, 35, 50, 65, 81, 97, 193, 115, 145, 161, 255, 196, 0, 22, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 4, 2, 255, 196, 0, 30, 17, 0, 2, 3, 0, 2, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 3, 17, 33, 65, 18, 19, 49, 97, 255, 218, 0, 12, 3, 1, 0, 2, 17, 3, 17, 0, 63, 0, 135, 161, 164, 106, 218, 129, 10, 201, 28, 100, 140, 238, 145, 176, 52, 234, 62, 147, 158, 72, 203, 69, 43, 78, 113, 149, 240, 98, 102, 7, 223, 68, 193, 100, 161, 90, 116, 144, 64, 211, 3, 26, 185, 103, 144, 129, 200, 207, 97, 141, 94, 219, 25, 36, 181, 82, 54, 214, 192, 140, 40, 85, 39, 3, 28, 126, 181, 87, 164, 162, 134, 97, 246, 24, 176, 19, 130, 103, 20, 253, 21, 123, 155, 230, 166, 72, 191, 146, 69, 7, 250, 26, 22, 178, 209, 29, 13, 185, 165, 149, 217, 229, 108, 20, 219, 192, 3, 60, 231, 90, 212, 149, 42, 184, 116, 222, 192, 28, 98, 53, 220, 73, 7, 159, 247, 141, 71, 245, 37, 177, 5, 142, 170, 100, 89, 199, 133, 207, 196, 85, 24, 5, 187, 96, 115, 162, 1, 85, 73, 97, 16, 111, 83, 133, 159, 51, 89, 105, 251, 200, 76, 37, 64, 83, 140, 96, 253, 126, 250, 99, 111, 189, 201, 71, 68, 180, 235, 76, 36, 42, 73, 12, 88, 246, 39, 236, 53, 39, 102, 185, 91, 232, 233, 21, 106, 154, 160, 184, 102, 202, 196, 163, 183, 24, 228, 159, 93, 22, 253, 81, 111, 140, 98, 158, 214, 239, 249, 154, 111, 208, 26, 170, 187, 106, 21, 120, 217, 204, 7, 86, 47, 169, 196, 126, 47, 181, 104, 204, 33, 9, 17, 99, 146, 64, 220, 125, 6, 149, 117, 12, 213, 53, 22, 185, 38, 51, 201, 190, 79, 43, 160, 242, 238, 0, 228, 240, 62, 159, 141, 42, 126, 171, 171, 18, 7, 166, 166, 166, 167, 199, 96, 170, 79, 191, 39, 64, 87, 223, 46, 55, 20, 9, 85, 82, 206, 128, 238, 10, 0, 80, 15, 183, 174, 138, 235, 145, 134, 34, 231, 236, 218, 33, 94, 231, 255, 217] }
    },
    "participant": "",
    "timestamp": 1648731134
}
```

 ###### Enviar Audio 
```php
echo $whatsapp->sendAudio(array("chatId" =>  5566996852025, "url" => "https://ringtonazer.b-cdn.net/fetch/c3/c3dc619b099469663dae3a847273d793.mp3"));
```
 ######  Retorno 
```json
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "audio",
    "isMedia": true,
    "id": "BAE5521DFBDB2F3B",
    "to": "556696852025",
    "content": "",
    "isgroup": false,
    "file": { "url": "https://mmg.whatsapp.net/d/f/Av8fWFrNg6W99OYEO8LAu4daZATJXoSHXhZa4h6SiJFE.enc", "mimetype": "audio/ogg; codecs=opus", "fileSha256": { "type": "Buffer", "data": [151, 83, 32, 149, 126, 140, 192, 157, 49, 227, 242, 54, 209, 84, 33, 169, 238, 117, 1, 198, 194, 11, 202, 103, 85, 192, 94, 0, 134, 62, 31, 30] }, "fileLength": { "low": 703262, "high": 0, "unsigned": true }, "seconds": 29, "mediaKey": { "type": "Buffer", "data": [23, 172, 158, 33, 40, 65, 186, 99, 59, 117, 197, 76, 208, 61, 251, 100, 124, 209, 247, 136, 10, 11, 142, 247, 101, 98, 39, 168, 56, 26, 199, 55] }, "fileEncSha256": { "type": "Buffer", "data": [188, 136, 27, 69, 130, 195, 118, 112, 74, 75, 147, 162, 218, 38, 180, 65, 143, 43, 185, 195, 5, 162, 65, 238, 122, 87, 147, 133, 174, 183, 174, 81] }, "directPath": "/v/t62.7114-24/11853508_1690182314657551_6302449806767110723_n.enc?ccb=11-4&oh=01_AVysBRkfdOCJ_DNHbRTdUwH7zphIvPqPHrisiEPojz0JUg&oe=626A9134" },
    "participant": "",
    "timestamp": 1648731691
}
```

 ###### Enviar Contato  
```php
echo $whatsapp->sendContato(array("chatId" => 5566996852025, "name" => "Raphael Serafim", "contact" => "66996852025"));
```
 ######  Retorno 
```json
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "contact",
    "isMedia": false,
    "id": "BAE5C2FD72D893F3",
    "to": "556696852025",
    "display": "Raphael Serafim",
    "vcard": "BEGIN:VCARD\nVERSION:3.0\nFN:Raphael Serafim\nORG:Raphael Serafim;\nTEL;type=CELL;type=VOICE;waid=66996852025:+55 66996852025\nEND:VCARD",
    "isgroup": false,
    "timestamp": 1648732036
}
```

 ###### Enviar Link   
```php
echo $whatsapp->sendLink(array("chatId" => 5566996852025, "text" => "Conheça a Cache Sistemas Visite o Nosso site", "url" => "https://www.cachesistemas.com.br"));
```
 ######  Retorno 
```json 
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "link",
    "isMedia": false,
    "id": "BAE5C74905409493",
    "to": "556696852025",
    "content": "https://www.cachesistemas.com.br\nConheça a Cache Sistemas Visite o Nosso site",
    "isgroup": false,
    "participant": "",
    "timestamp": 1648732328
}
```

 ###### Enviar Botão com Ação    
```php
 echo $whatsapp->sendButtonAction(array("chatId" => 5566996852025, "title" => "Visitar o site",  "description" => "Visite agora", "buttonText" => "Acessar", "buttonSet" => "https://www.cachesistemas.com.br", "action" => "url"));
```
 ######  Retorno 
```json 
 
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "buttons-md",
    "isMedia": false,
    "id": "BAE578E402F64EAC",
    "to": "556696852025",
    "title": "Visitar o site",
    "description": "Visite agora",
    "isgroup": false,
    "timestamp": 1648732727
}
```

 ######  Criar Grupo   
```php
 echo $whatsapp->criarGrupo(array("name" => "API WhatsApp PHP", "participants" => "5566996852025"));

```
 ######  Retorno 
```json 
{
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "type": "create-group",
    "status": 200,
    "groupId": "120363042927751450"
}
```

 ######  Alterar Imagem Perfil do  Grupo   
```php
echo $whatsapp->mudarImagemGrupo(array("groupId" => "120363042927751450", "url" => "https://repository-images.githubusercontent.com/252264656/b0cf2c00-f436-11ea-9270-bf9297984c6b")); 
```
 ######  Retorno 
```json 
 {
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "type": "set-picture",
    "status": 200
}
```

 ######  Alterar Descrição  do  Grupo   
```php
 echo $whatsapp->mudarDescricaoGrupo(array("groupId" => "120363042927751450", "description" => "PHP é vida !")); 
```
 ######  Retorno 
```json 
  {
    "container": "api-3",
    "session": "3",
    "device": "556696883327",
    "status": 200,
    "type": "group-descript"
}
```






