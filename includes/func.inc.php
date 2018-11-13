<?php 

function getRankPic($score) {
    if($score>1100){
        return  'chevron11';
    }else if($score>1000){
        return  'chevron10';
    }else if($score>900){
        return  'chevron9';
    }else if($score>800){
        return  'chevron8';
    }else if($score>700){
        return  'chevron7';
    }else if($score>600){
        return  'chevron6';
    }else if($score>500){
        return  'chevron5';
    }else if($score>400){
        return  'chevron4';
    }else if($score>300){
        return  'chevron3';
    }else if($score>200){
        return  'chevron2';
    }else if($score>100){
        return  'chevron1';
    }else {
        return  'chevron0';
    }
}
function highlight($text, $words, $color)
        {
                    $split_words = explode( " " , $words );
                    foreach ($split_words as $word)
                    {	$word = trim($word);
                        if($word == '') continue;
                        //$color = generate_colors();
                        //s$color = $colorSet[$word];
                        $text = preg_replace("|($word)|Ui" ,
                                "<span style=\"background:".$color.";\"><b>$1</b></span>" , $text );
                    }
                    return $text;
        }

function allHighlight($text){
    $text = highlight($text, 'algorithm', 'yellow');
    $text = highlight($text, '\swe\s', 'aqua');
    $text = highlight($text, '=-=(.+)-=-', 'lightblue');

    $keywords = array("use", "apply", "applied", "using", "derive", "implement","develop", "extend", "adapt"
                    , "extension", "improvement", "improve", "modified", "modification", "new algorithm","algorithm"
                    ,"algorithms","method","methodology","methods","methodologies","approach","approaches","procedure"
                    ,"procedures","protocol","protocols","routine","routines","classification","classifier","classifications"
                    ,"classifiers","regression","regressor","forecaster","regressions","regressors","forecasters","learning"
                    ,"learner","learners","mechanism","mechanisms","technique","techniques","framework","frameworks","model"
                    ,"models","scheme","schemes","signature","signatures","system","cryptosystem","systems","cryptosystems"
                    ,"structure","structures",);
    foreach ($keywords as $key) {
        $text = highlight($text,$key,"#ff9999");
    }
    return $text;
}