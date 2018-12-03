<?php

include '../Controller/ErroController.php';
include '../Controller/GetConfigApp.php';
include 'Infra/DbContextoDAO.php';
include 'Infra/CollectionsQuerys.php';
include 'Conexao.php';
include 'AnuncioDAO.php';

include '../NucleoClass/PessoaDTO.php';
include '../NucleoClass/AnuncioDTO.php';

$Con = new Conexao();

AnuncioDAO::BuscarAnuncio($Con->getCon());

//PostDAO::salvePost($post, $con->getCon());
//print_r( PostDAO::quantidadePost($con->getCon()) );