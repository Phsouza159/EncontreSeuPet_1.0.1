<?php

include_once __DIR__ . '/ErroController.php';

Class PaginacaoPots{ 

    private $numPost;                     // quantidade de posters   
    private $posts;                        // array com pots
    private $numPostForBloc;              // quantidade de posts por bloco de exibicao
    private $numForPost;                  // numero de butoes necessarios para navegar entre os blocos que contem o postesMini
    private $atualNumMiniPost;            // bloco atual do posters -- um blco igual a @var numPostForBloc
    private $atualBlocMiniPost;           // o bloco atual em que esta a pag
    private $numQntExibirButtons;         // quantidade de buttons que vai na exibicao do nav buttons
    private $pagUrl;                      // aux para a pagina que vai a fucao
    private $controleDireitaEsquerda = false;
    private $postsNames = array();
    private $TipoPost;
    
    public function __construct(
                                $numPost = 0, 
                                $posts = null, 
                                $TipoPost = 1,
                                $numPostForBloc = 5,
                                $numQntExibirButtons = 6, 
                                $pagUrl = "./Posts.php") {

        $this->numPost = count($posts);
        $this->numPostForBloc = $numPostForBloc;
        $this->numQntExibirButtons = $numQntExibirButtons;
        $this->pagUrl = $pagUrl;
        $this->CarregarPost($posts);
        $this->TipoPost = $TipoPost;
    }
    public function CarregarPost($posts) {

        $this->posts = $posts;
        $pots_ = array();

        for ($i = 0; $i < count($posts); $i++) {
            $pots_[] = $posts[$i]['CaminhoPost'];
        }

        $this->setPostsNames($pots_);
    }

    private function setPosts($posts) {
        $this->posts = $posts;
    }

    private function getPosts() {
        return $this->posts;
    }

    private function getPostsNames() {
        return $this->postsNames;
    }

    private function setPostsNames($postsNames) {
        $this->postsNames = $postsNames;
    }

    private function getNumPost() {
        return $this->numPost;
    }

    private function setNumPost($numPost) {
        $this->numPost = $numPost;
    }


    public function ViewMiniPost() {

        if ($this->posts == null) {
            
            echo "<a class='h1 p-5'>Sem registro :(";
            
            return;
        }

        $this->GetNumMiniPostNav();
        $this->GetAtualNavPost();

        echo "<div class='row'>";

        for ($x = $this->atualNumMiniPost; $x < $this->atualNumMiniPost + $this->numPostForBloc; $x++) {

            if($x >= count($this->posts))
            {       
                //break;    
            }
            $this->GetMiniPost($this->posts[$x - 1]);

            if (($x % 2 == 0)) {
                echo "</div>";
                AnuncioDTO::GerarAnuncio();
                echo "<div class='row'>";
            }

            if ($x == $this->numPost) // Controlador -- bloquear de exibir mais posters do que existe
                break;
        }
        echo"</div>";
        $this->GetNavBarMiniPost();
    }

    private function GetNavBarMiniPost() {
        $auxAnter;          // valor do nav buttom anterior ao atual nav
        $auxProx;           // valor do proximo nav buttom ao atual nav
        $auxInicialNav;     // valor do primeiro nav buttom
        $auxFinalNav;       // valor do ultimo nav buttom

        $this->SetValButtoAnter($auxAnter);
        $this->SetValButtoNext($auxProx);
        $this->SetEfectButton($auxInicialNav, $auxFinalNav);


        echo "<nav aria-label='Page navigation example'>
                  <ul class='pagination justify-content-center pagination-sm'>";


        if (1 == $this->atualBlocMiniPost) {
          
            echo "<li class='page-item disabled'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=1&tipo=$this->TipoPost'><b><<</b></a></li>";
            echo "<li class='page-item disabled'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$auxAnter&tipo=$this->TipoPost'><b><</b></a></li>";
        
            
        } else {
            
            echo "<li class='page-item'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=1&tipo=$this->TipoPost'><b><<</b></a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$auxAnter&tipo=$this->TipoPost'><b><</b></a></li>";
        }

        for ($x = $auxInicialNav; $x <= $auxFinalNav; $x++) {

            if ($x == $this->atualBlocMiniPost) { // da efeito visual a onde o nav atual do bloco fica com a cor  > se ta no nav buttom 2 = o buttom 2 fica com a cor
               
                echo "<li class='page-item active'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$x&tipo=$this->TipoPost'>" . $x . "</a><span class='sr-only'>(current)</span></li>";
       
             } else { // demais buttons
                 
                echo "<li class='page-item'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$x&tipo=$this->TipoPost'>" . $x . "</a></li>";
            }
        }


        if ($this->atualBlocMiniPost == $auxFinalNav) {
         
            echo "<li class='page-item disabled'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$auxProx&tipo=$this->TipoPost'><b>></b></a></li>";
            echo "<li class='page-item disabled'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=$this->numForPost&tipo=$this->TipoPost'><b>>></b></a></li>";
        
            
        } else {
            
            echo "<li class='page-item'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=" . $auxProx . "'><b>></b></a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $this->pagUrl . "?AtualNavPost=" . $this->numForPost . "'><b>>></b></a></li>";
        }

        echo "</ul>
          </nav>";
    }
    /**
     * 
     */
    private function SetValButtoAnter(&$Anter) {
        if ($this->atualBlocMiniPost <= 1) {
            $Anter = 1;
        } else {
            $Anter = ($this->atualBlocMiniPost - 1 );
        }
    }

    /**
     * 
     * @param type $prox
     */
    private function SetValButtoNext(&$prox) {
        if ($this->atualBlocMiniPost >= $this->numForPost) {
            $prox = $this->atualBlocMiniPost;
        } else {
            $prox = ($this->atualBlocMiniPost + 1 );
        }
    }

    /**
     * 
     * @param type $auxInicialNav
     * @param type $auxFinalNav
     * @return type
     */
    private function SetEfectButton(&$auxInicialNav, &$auxFinalNav) {
        $numButtonsExibicao = $this->numQntExibirButtons; // Carregar a quantidade de exibicao de buttons

        if ($numButtonsExibicao >= $this->numPost) { // mecanismo de controle de erro --- numero de posts menor que a de buttons a exibir
            $numButtonsExibicao = $this->numPost;
            $auxInicialNav = 1;
            $auxFinalNav = $this->numForPost;
            return null;
        }
        $intervaloDeButons = $numButtonsExibicao / 2; // Carregar intervalo do efeito

        $qntButtoesNecessario = $this->numPost / $this->numPostForBloc;

        $qntButtoesNecessario = is_float($qntButtoesNecessario) // verificar se o resultdao da divisao de um numero real
                ? intval($qntButtoesNecessario) + 1 // se for numero real, pegar o seu valor inteiro e somar +1 ;
                : $qntButtoesNecessario;


        $intervaloDeButons = is_float($intervaloDeButons) // verificar se o resultdao da divisao de um numero real
                ? intval($intervaloDeButons) + 1 // se for numero real, pegar o seu valor inteiro e somar +1 ;
                : $intervaloDeButons;

        if ($this->atualBlocMiniPost <= $intervaloDeButons) { // incio dos nav -- efeito OFF
            $auxInicialNav = 1;
            $auxFinalNav = $qntButtoesNecessario <= $intervaloDeButons ? $numButtonsExibicao : $numButtonsExibicao > $qntButtoesNecessario ? $qntButtoesNecessario : $numButtonsExibicao;
        } else {
            $auxInicialNav = $this->atualBlocMiniPost - $intervaloDeButons; // pegar o atual e diminuir pelo raio do efeito a esquerda (inicio)
            $auxFinalNav = $this->atualBlocMiniPost + $intervaloDeButons; // pegar o atual e aumentar pelo raio do efeito a direita (final)

            if ($auxFinalNav > $this->numForPost) { // quando chegar no limite de exibicao dos navs buttons o efeito para -- efeito OFF
                $auxFinalNav = $this->numForPost;  // final pega o ultimo buttom
                $auxInicialNav = ($auxFinalNav - $numButtonsExibicao) <= 0 ? 1 : ($auxFinalNav - $numButtonsExibicao);
            }
        }
    }
    /**
     * 
     * @param type $post
     */
    private function  GetMiniPost($post)
    {
           include __DIR__ . "../../View/Site/Layout/ModeMiniPost.php"; 
    }
    private function GetAtualNavPost() {
        $aux = isset($_GET["AtualNavPost"]) ?
                $_GET["AtualNavPost"] :
                1;

        if ($aux > 0 && $aux <= $this->numForPost) {
            $this->atualBlocMiniPost = $aux;
        } else {
            $this->atualBlocMiniPost = 1;
        }


        if ($aux < 0 || $aux == 1 || $aux > $this->numForPost || $aux == "") {
            $aux = 1;
        } elseif ($aux == 2) {
            $aux += ($this->numPostForBloc - 1);
        } else {
            $aux = ($aux * $this->numPostForBloc ) - ($this->numPostForBloc - 1);
        }

        $this->atualNumMiniPost = $aux;
    }

    private function GetNumMiniPostNav() {
        $aux = $this->numPost / $this->numPostForBloc;
        if (is_float($aux)) {
            $aux = intval($aux) + 1;
        }
        if ($aux < 0) {
            $this->numForPost = 0;
        }
        $this->numForPost = $aux;
    }

}
