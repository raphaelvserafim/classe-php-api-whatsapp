<?php



namespace API;


class Container
{

    private $token;
    private $url;

    public function __construct($dados)
    {

        $this->vazio($dados["url"]);
        $this->vazio($dados["token"]);

        $this->url      = $dados["url"];
        $this->token    = $dados["token"];
    }


    private function vazio($value)
    {
        if (empty($value)) {
            echo json_encode(array("status" => false, "mensagem" => "campo obrigatório vazio"));
            exit;
        }
    }


    public function criar($id, $memoria)
    {
        $id =  preg_replace("/\D/", "", $id);
        $this->vazio($id);
        $this->vazio($memoria);

        return  file_get_contents($this->url . '/run/' . $this->token . '/' . $id . '/' . $memoria);
    }

    public function lista()
    {
        $containes =  file_get_contents($this->url . '/list/' . $this->token);
        $containes = explode("\n", $containes);
        $array     = array();
        for ($i = 1; sizeof($containes) >= $i; $i++) {
            if (!empty($containes[$i])) {
                $c = explode(" ", $containes[$i]);
                array_push($array, array("codigo" => $c[0], "api" =>  preg_replace("/\D/", "", $c[sizeof($c) - 1])));
            }
        }

        return json_encode($array);
    }

    public function start($id)
    {
        $this->vazio($id);
        return  file_get_contents($this->url . '/start/' . $this->token . '/' . $id);
    }

    public function stop($id)
    {
        $this->vazio($id);
        return  file_get_contents($this->url . '/stop/' . $this->token . '/' . $id);
    }

    public function deletar($id)
    {
        $this->vazio($id);
        return  file_get_contents($this->url . '/delete/' . $this->token . '/' . $id);
    }
}
