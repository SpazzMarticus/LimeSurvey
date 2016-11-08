<?php
/**
 * Multiple choice with comments question, item Html
 * @var $liclasses
 * @var $liid
 * @var $kpclass
 * @var $title
 * @var $sDisplayStyle
 * @var $name                       $myfname
 * @var $id                         answer$myfname
 * @var $value                       Y
 * @var $classes                    ''
 * @var $checked                    ''
 * @var $checkconditionFunction     $checkconditionFunction(this.value, this.name, this.type);
 * @var $checkconditionFunctionComment
 * @var $labeltext                  $ansrow['question']
 * @var $javaname                   java$myfname
 * @var $javavalue                  ''
 * @var $checked                    if (isset($_SESSION['survey_'.Yii::app()->getConfig('surveyID')][$myfname]))  ...
 * @var $inputCommentId             'answer'.$myfname2
 * @var $commentLabelText           gT('Make a comment on your choice here:'); ?>
 * @var $inputCommentName           $myfname2
 * @var $inputCOmmentValue          if (isset($_SESSION['survey_'.Yii::app()->getConfig('surveyID')][$myfname2])) {$answer_main .= htmlspecialchars($_SESSION['survey_'.Yii::app()->getConfig('surveyID')][$myfname2],ENT_QUOTES);}
 */
?>
<!-- answer_row -->
<li id="javatbd<?php echo $name; ?>" class='row checkbox-text-item form-group clearfix'  <?php echo $sDisplayStyle ;?>>
    <!-- Checkbox + label -->
    <div class="col-sm-<?php echo $sLabelWidth; ?> col-xs-12">
        <div class="checkbox-item answer-item form-group">
            <input
                class="<?php echo $classes; echo $kpclass; ?>"
                title="<?php echo $title;?>"
                type="checkbox"
                name="<?php echo $name; ?>"
                id="<?php echo $id;?>"
                value="<?php echo $value?>"
                <?php echo $checked;?>
              />

            <label id="label-<?php echo $id;?>" for="<?php echo $id;?>" class="control-label checkbox-label"><?php echo $labeltext;?></label>

            <?php if($javainput):?>
                <input
                type='hidden'
                name='<?php echo $javaname?>'
                id='<?php echo $javaname?>'
                value='<?php echo $javavalue;?>'
                <?php echo $checked;?>
                />
            <?php endif;?>
        </div>
    </div>

    <!-- Comment -->
    <div class="col-sm-<?php echo $sInputContainerWidth; ?> col-xs-12">
        <div class="form-group answer-item text-item comment-item">
            <input
                class='form-control <?php echo $kpclass; ?>'
                type='text'
                id='<?php echo $inputCommentId;?>'
                name='<?php echo $inputCommentName; ?>'
                value='<?php echo $inputCOmmentValue; ?>'
                aria-labelled='label-<?php echo $id;?>'
            />
        </div>
    </div>
</li>
<!-- end of answer_row -->
