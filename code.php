<?php
    function getMunicipios()
    {
        $url = 'http://extranet.artesp.sp.gov.br/origemDestino/include/asp/combos.asp?municipios=1&string=';
        $data = file_get_contents($url);
        return trim($data);
    }

    function retirarLixo($data)
    {
        $lixo = [
            '<?xml version=\'1.0\' encoding=\'ISO-8859-1\'?>', '<Combos>', '</Combos>', '<Secoes>', '</Secoes>', '<Secao data="'
        ];        

        foreach($lixo as $value){
            $data = str_replace($value, '', $data);
        }

        $enter = [
            ";" => '"/>', ',' => 'label="'
        ];

        foreach($enter as $key => $value){
            $data = str_replace($value, $key, $data);
        }

        $data = str_replace('"', '', $data);
        $data = str_replace(' ', '', $data);

        return $data;
    }

    $ret = retirarLixo(getMunicipios());

    $ret = explode(';', $ret);
    
    array_pop($ret);

    $array;
    foreach($ret as $value){
        $tmp = explode(',', $value);
        $array[$tmp[0]] = $tmp[1];
    }

    print_r($array);
    
?>