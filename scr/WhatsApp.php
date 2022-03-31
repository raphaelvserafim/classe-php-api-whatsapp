<?php


namespace API;

use HTTP_Request2;
use HTTP_Request2_Exception;

class WhatsApp
{

    private $parth;
    private $body;
    private $header = array();
    private $apikey;
    private $session;
    private $token;
    private $url_api;
    private $wh_connect;
    private $wh_qrcode;
    private $wh_status;
    private $wh_message;


    public function __construct($config)
    {
        $this->vazio($config["apikey"]);
        $this->vazio($config["session"]);
        $this->vazio($config["token"]);
        $this->vazio($config["url_api"]);

        $this->apikey       = $config["apikey"];
        $this->session      = $config["session"];
        $this->token        = $config["token"];
        $this->url_api      = $config["url_api"];

        $this->wh_connect   = $config["wh_connect"];
        $this->wh_qrcode    = $config["wh_qrcode"];
        $this->wh_status    = $config["wh_status"];
        $this->wh_message   = $config["wh_message"];
    }



    private function vazio($value)
    {
        if (empty($value)) {
            echo json_encode(array("status" => false, "mensagem" => "campo obrigatório não preenchido"));
            exit;
        }
    }


    private function requestPost()
    {

        $array  =  array('apikey' =>  $this->apikey, 'session' => $this->session);

        array_push($this->header, $array);

        $request = new HTTP_Request2();
        $request->setUrl($this->url_api . $this->parth);
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setHeader($this->header);
        $request->addPostParameter($this->body);
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return $response->getBody();
            } else {
                return  $response->getReasonPhrase();
            }
        } catch (HTTP_Request2_Exception $e) {
            return   $e->getMessage();
        }
    }


    public function conectar()
    {
        $this->parth = '/api-' . $this->session . '/whatsapp/connect';

        $this->header = array(
            'token' =>  $this->token,
            'multidevice' => 'true',
            'onmessage' => 'true',
            'onack' => 'true',
            'onpresence' => 'true',
            'ongroups' => 'false',
            'onparticipants' => 'false',
            'ondelete' => 'false',
            'autoread' => 'true'
        );

        $this->body      =   array(
            'wh_connect' =>  $this->wh_connect,
            'wh_qrcode'  =>  $this->wh_qrcode,
            'wh_status'  =>  $this->wh_status,
            'wh_message' =>  $this->wh_message,
            'wh_battery' =>  $this->wh_status,
            'wh_presence' =>  $this->wh_status,
            'wh_delete'   =>  $this->wh_status,
            'wh_participants'   =>  $this->wh_status,
            'wh_groups'   =>  $this->wh_status,
        );


        echo  $this->requestPost();
    }



    public function  sendPresena($dados)
    {
        // $dados = array("chatId" => 5566996852025, "state" => "c"); c = digitando, r = gravando, a = online, p = offline
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["state"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/setpresence';
        $this->body  =  array('chatId' =>  $dados["chatId"], 'state' =>  $dados["state"]);
        return  $this->requestPost();
    }


    public function sendText($dados)
    {
        // $dados = array("chatId" => 5566996852025, "text" => " Oie ");
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["text"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/text';
        $this->body  = array('chatId' => $dados["chatId"], 'text'  =>  $dados["text"]);
        return  $this->requestPost();
    }

    public function sendImagem($dados)
    {
        // $dados = array("chatId" => 5566996852025, "text" => " Oie " ,"url"=> "");
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/image';
        $this->body  =  array('chatId'  =>  $dados["chatId"], 'text'  =>  $dados["text"], 'url'  =>  $dados["url"]);
        return  $this->requestPost();
    }

    public function sendVideo($dados)
    {
        // $dados = array("chatId" => 5566996852025, "text" => " Oie " ,"url"=> ""); MP4
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/video';
        $this->body      =   array(
            'chatId'     =>  $dados["chatId"],
            'text'       =>  $dados["text"],
            'url'        =>  $dados["url"],
        );
        return  $this->requestPost();
    }

    public function sendAudio($dados)
    {
        // $dados = array("chatId" => 5566996852025, "url"=> ""); MP3 
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/voice';
        $this->body  =   array('chatId' =>  $dados["chatId"], 'url' =>  $dados["url"]);
        return  $this->requestPost();
    }


    public function sendFile($dados)
    {
        // $dados = array("chatId" => 5566996852025, "filename"=> "PDF exemplo" "url"=> "");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/file';
        $this->body  =   array('chatId' =>  $dados["chatId"], 'url' =>  $dados["url"], 'filename' =>  $dados["filename"]);
        return  $this->requestPost();
    }


    public function sendContato($dados)
    {
        // $dados = array("chatId" => 5566996852025, "name"=> "Raphael Serafim", "contact"=> "5566996852025");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["name"]);
        $this->vazio($dados["contact"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/contact';
        $this->body      =   array('chatId'   =>  $dados["chatId"], 'name'  =>  $dados["name"], 'contact'  =>  $dados["contact"]);
        return  $this->requestPost();
    }


    public function sendLocalizacao($dados)
    {
        // $dados = array("chatId" => 5566996852025, "lat"=> "", "log"=> "", "title"=> "", "address"=>"");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["lat"]);
        $this->vazio($dados["log"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/location';
        $this->body      =   array(
            'chatId'     =>  $dados["chatId"],
            'lat'        =>  $dados["lat"],
            'log'        =>  $dados["log"],
            'title'      =>  $dados["title"],
            'address'    =>  $dados["address"]
        );
        return  $this->requestPost();
    }



    public function sendLink($dados)
    {
        // $dados = array("chatId" => 5566996852025, "text"=> "", "url"=> "");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/send/link';
        $this->body      =   array('chatId'  =>  $dados["chatId"], 'text'  =>  $dados["text"], 'url' =>  $dados["url"]);
        return  $this->requestPost();
    }






    public function sendButtons($dados)
    {
        // $dados = array("chatId" => 5566996852025, "title" => "Qual sua linguagem ?", "buttons" => " PHP,  JS, HTML", "description" => "Escolha  uma"); exemplo 
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["buttons"]);
        $this->parth  = '/api-' . $this->session . '/whatsapp/send/buttons';
        $this->body   =  array('chatId' =>  $dados["chatId"], 'title'  =>  $dados["title"], 'buttons'  =>  $dados["buttons"], 'description'   =>  $dados["description"]);
        return  $this->requestPost();
    }

    public function sendButtonAction($dados)
    {
        // $dados = array("chatId" => 5566996852025, "title" => "Visitar o site",  "description" => "Visite agora", "buttonText" => "Acessar", "buttonSet" => "", "action" => "url");
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["buttonText"]);
        $this->vazio($dados["buttonSet"]);
        $this->vazio($dados["action"]);
        $this->parth  = '/api-' . $this->session . '/whatsapp/send/buttonaction';
        $this->body   =   array('chatId'  =>  $dados["chatId"], 'title' =>  $dados["title"], 'description'   =>  $dados["description"], 'buttonText' =>  $dados["buttonText"], 'buttonSet'  =>  $dados["buttonSet"], 'action'  =>  $dados["action"]);
        return  $this->requestPost();
    }






    public function mudarImagemPerfil($dados)
    {
        // $dados = array("chatId" => 5566996852025,  "url"=> "");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/setprofilepic';
        $this->body  =   array('chatId'   =>  $dados["chatId"], 'url'   =>  $dados["url"]);
        return  $this->requestPost();
    }

    public function getFotoPerfilContato($dados)
    {
        // $dados = array("chatId" => 5566996852025 );   
        $this->vazio($dados["chatId"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/profilepic';
        $this->body  =  array('chatId' =>  $dados["chatId"]);
        return  $this->requestPost();
    }


    public function getNomeContato($dados)
    {
        // $dados = array("chatId" => 5566996852025 );   
        $this->vazio($dados["chatId"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/getname';
        $this->body  = array('chatId'     =>  $dados["chatId"]);
        return  $this->requestPost();
    }



    // GRUPOS 
    public function obterGrupos()
    {
        $this->parth = '/api-' . $this->session . '/whatsapp/allgroups';
        return  $this->requestPost();
    }

    public function   criarGrupo($dados)
    {
        // $dados = array("name" => " TESTE ", "participants"=>"5566996852025");   
        $this->vazio($dados["name"]);
        $this->vazio($dados["participants"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/creategroup';
        $this->body  = array('name' =>  $dados["name"], 'participants' =>  $dados["participants"]);
        return  $this->requestPost();
    }



    public function   mudarImagemGrupo($dados)
    {
        // $dados = array("groupId" => "0388455-9998", "url"=>"");   
        $this->vazio($dados["groupId"]);
        $this->vazio($dados["url"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/setgrouppic';
        $this->body  =  array('groupId' =>  $dados["groupId"], 'url' =>  $dados["url"]);
        return  $this->requestPost();
    }


    public function    adicionarParticipanteGrupo($dados)
    {
        // $dados = array("groupId" => "0388455-9998", "participants"=>"");   
        $this->vazio($dados["groupId"]);
        $this->vazio($dados["participants"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/addparticipants';
        $this->body  =  array('groupId'  =>  $dados["groupId"], 'participants'  => $dados["participants"]);
        return  $this->requestPost();
    }


    public function  removerParticipanteGrupo($dados)
    {
        // $dados = array("groupId" => "0388455-9998", "participants"=>"");   
        $this->vazio($dados["groupId"]);
        $this->vazio($dados["participants"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/removeparticipant';
        $this->body         =   array(
            'groupId'       =>  $dados["groupId"],
            'participants'  =>  $dados["participants"]
        );
        return  $this->requestPost();
    }



    public function  mudarNomeGrupo($dados)
    {
        // $dados = array("groupId" => "0388455-9998", "name"=>"");   
        $this->vazio($dados["groupId"]);
        $this->vazio($dados["name"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/setgroupname';
        $this->body         =   array(
            'groupId'       =>  $dados["groupId"],
            'name'          =>  $dados["name"]
        );
        return  $this->requestPost();
    }


    public function  mudarDescricaoGrupo($dados)
    {
        // $dados = array("groupId" => "0388455-9998", "description"=>"");   
        $this->vazio($dados["groupId"]);
        $this->vazio($dados["description"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/setgroupdescription';
        $this->body  = array('groupId'  =>  $dados["groupId"], 'description'  =>  $dados["description"]);
        return  $this->requestPost();
    }

    public function  decryptSalvarMidia($dados)
    {
        // $dados = array("chatId" => "5566996852025", "msgId"=>"" , "filename"=> "");   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["msgId"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/decryptByIdFileSave';
        $this->body  = array('chatId'  =>  $dados["chatId"], 'msgId'  =>  $dados["msgId"], "filename" => $dados["filename"]);
        return  $this->requestPost();
    }

    public function  decryptByIdFile($dados)
    {
        // $dados = array("chatId" => "5566996852025", "msgId"=>""  );   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["msgId"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/decryptByIdFile';
        $this->body  = array('chatId'  =>  $dados["chatId"], 'msgId'  =>  $dados["msgId"]);
        return  $this->requestPost();
    }

    public function  decryptremote($dados)
    {
        // $dados = array("chatId" => "5566996852025", "msgId"=>""  );   
        $this->vazio($dados["chatId"]);
        $this->vazio($dados["msgId"]);
        $this->parth = '/api-' . $this->session . '/whatsapp/decryptremote';
        $this->body  = array('chatId'  =>  $dados["chatId"], 'msgId'  =>  $dados["msgId"]);
        return  $this->requestPost();
    }


    



    // 


    public function desconectar()
    {   //Desconecta o número sem remover o token, assim se tentar conectar novamente não precisará ler o QRCODE 
        $this->parth = '/api-' . $this->session . '/whatsapp/disconnect';
        return  $this->requestPost();
    }


    public function logout()
    {   // Sai do Whatsapp e remove o token, assim quando tentar conectar novamente precisará fazer a leitura do QRCODE novamente
        $this->parth = '/api-' . $this->session . '/whatsapp/logout';
        return  $this->requestPost();
    }




    public function obterContatos()
    {
        $this->parth = '/api-' . $this->session . '/whatsapp/allcontacts';
        return  $this->requestPost();
    }


    public function statusConexao()
    {

        $this->parth = '/api-' . $this->session . '/whatsapp/connectionstate';
        return  $this->requestPost();
    }



    public function nivelBateria()
    {
        $this->parth = '/api-' . $this->session . '/whatsapp/batterylevel';
        return  $this->requestPost();
    }



    public function getInfoDevice()
    {
        $this->parth = '/api-' . $this->session . '/whatsapp/gethostdevice';
        return  $this->requestPost();
    }
}
