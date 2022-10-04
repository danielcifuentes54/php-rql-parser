<?php
require 'vendor/autoload.php';

class API {
  function rqlParser(){
    // default lexer supports all RQL rules
    $lexer = new Graviton\RqlParser\Lexer();
    // default parser contains all parsing strategies
    $parser = new Graviton\RqlParser\Parser();
    // RQL code
    $rql = 'name=eq=juan&sort(-id,+age)&limit(50)';
    // tokenize RQL
    $tokens = $lexer->tokenize($rql);
    // parsing
    $parsing = $parser->parse($tokens);
    $array = array(
      "offset" => $parsing->getLimit()->getOffset(),
      "limit" => $parsing->getLimit()->getLimit(),
      "field" => $parsing->getQuery()->getField(),
      "value" => $parsing->getQuery()->getValue(),
      "sort" => $parsing->getSort()->getFields()
    );
    return json_encode($array);
  }
}

$API = new API;
header('Content Type: application/json');
echo $API->rqlParser();