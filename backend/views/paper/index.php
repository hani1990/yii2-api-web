<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2018/1/31
 * Time: 下午2:56
 */
?>
<html>
<head>
    <style>
        body{
            word-spacing:  25px;
            line-height: 200%;
            color: #000;
        }

        .qoptions li{
            list-style: none;
            margin-left:25px;
        }
        .exam{
            margin-left: 30%;
        }
        .question img{
            vertical-align:middle
        }
    </style>
</head>
<body>
<!--<ul>-->
<!--    --><?php //foreach ($list as $l){?>
<!--        <li>--><?php //echo $l['qtype_name'].'----'.$l['remark']?><!--</li>-->
<!--        --><?php //foreach ($l['questions'] as $q){?>
<!--            --><?php //echo $q['question_content'];?>
<!--        --><?php //}?>
<!--    --><?php //}?>
<!--</ul>-->
<div class="head">
    <p style="font-size: 30px;"><?php echo $paper['title']?></p>
    <div class="exam">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <span>考试时间: <?php echo $paper['exam_time']?>分钟</span> <span>试卷满分: <?php echo $paper['exam_score']?>分</span></div>
</div>


    <?php foreach ($list as $key => $l){?>

        <div class="question">
            <div class="qtype">
                <?php echo num2cn($key+1);?>、<?php echo $l['qtype_name'];?>：<?php echo $l['remark'];?>
            </div>
            <?php foreach ($l['questions'] as $k => $q){?>
                <div class="qcontent">
                    <?php echo $k+1;?>.<?php echo $q['question_content'];?> 
                </div>
                <?php  if($l['qtype'] == 1){?>
                <div class="qoptions">
                    <?php foreach ($q['options'] as $o){?>
                    <li><?php echo $o['option_name']?>．<?php echo $o['option_content']?></li>
                    <?php }?>
                </div>
                    <?php }?>
                <br>
             <?php }?>
        </div>
    <?php  }?>





</body>
</html>
