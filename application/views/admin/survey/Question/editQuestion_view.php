<?php $this->renderPartial("./survey/Question/question_subviews/_ajax_variables", $ajaxDatas); ?>

<?php
// Surely better in controller
if ($adding || $copying) 
{
    $sValidateUrl=$this->createUrl('admin/questions', array('sa' => 'ajaxValidate','surveyid'=>$surveyid));
}else{
    $sValidateUrl=$this->createUrl('admin/questions', array('sa' => 'ajaxValidate','surveyid'=>$surveyid,'qid'=>$qid));
}
?>



<script type='text/javascript'>
    var attr_url = "<?php echo $this->createUrl('admin/questions', array('sa' => 'ajaxquestionattributes')); ?>";
    var imgurl = '<?php echo Yii::app()->getConfig('imageurl'); ?>';
    var validateUrl = "<?php echo $sValidateUrl; ?>";
</script>

<script type='text/javascript'><?php echo $qTypeOutput; ?></script>

<?php PrepareEditorScript(true, $this); ?>




<div class="side-body" id="edit-question-body">
	<h3>
 <?php
    if ($adding) { ?>
        <?php eT("Add a new question"); ?>
        <?php } elseif ($copying) { ?>
        <?php eT("Copy question"); ?>
        <?php } else { ?>
        <?php eT("Edit question"); ?>
        <?php } ?>		
		
	</h3>
	<div class="row">
		<?php if(!$adding):?>
		    <?php echo CHtml::form(array("admin/database/index"), 'post',array('class'=>'form30','id'=>'frmeditquestion','name'=>'frmeditquestion')); ?>
		<div class="col-lg-8 content-right">
                <?php 
                    $addlanguages=Survey::model()->findByPk($surveyid)->additionalLanguages;
                    $this->renderPartial('./survey/Question/question_subviews/_tabs',array('eqrow'=>$eqrow,'addlanguages'=>$addlanguages, 'surveyid'=>$surveyid, 'gid'=>NULL, 'qid'=>NULL, 'adding'=>$adding, 'aqresult'=>$aqresult, 'action'=>$action ));                    
                ?>
			
			        
			        </div>
			        
			        
			        
			        
			        
			        
			        
			        
			        
			        
			        
            <div class="col-lg-4">
                <?php
                // TODO : find why the $groups can't be generated from controller 
                // $this->renderPartial('./survey/Question/newQuestion_subviews/_accordion_container', $accordionDatas); 
                ?>                
                <div id='questionbottom'>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" id="questionTypeContainer">
                            <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 <?php eT("General Option");?>
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div>
                                        <div  class="form-group">
                                            <label for='question_type_button'>
                                                <?php eT("Question Type:"); ?>
                                            </label>
                                            <br/>
                                            <?php if($selectormodeclass!="none"): ?>
                                                <?php
                                                    foreach (getQuestionTypeList($eqrow['type'], 'array') as $key=> $questionType)
                                                    {
                                                        if (!isset($groups[$questionType['group']]))
                                                        {
                                                            $groups[$questionType['group']] = array();
                                                        }
                                                        $groups[$questionType['group']][$key] = $questionType['description'];
                                                    }
                                                ?>
                                                
                                                <input type="hidden" id="question_type" name="type" value="<?php echo $eqrow['type']; ?>" />
                                                
                                                <div class="btn-group" id="question_type_button" style="z-index: 1000">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="z-index: 1000">
                                                        <?php foreach($groups as $name => $group):?>
                                                            <?php foreach($group as $type => $option):?>
                                                                <?php if($type == $eqrow['type']){echo '<span class="buttontext">' . $option . '</span>';}?>
                                                            <?php endforeach;?>    
                                                        <?php endforeach;?>
                                                        &nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                                    </button>
                                                    
                                                    <ul class="dropdown-menu" style="z-index: 1000">
                                                        
                                                        <?php foreach($groups as $name => $group):?>
                                                            <small><?php echo $name;?></small>
                                                           
                                                           <?php foreach($group as $type => $option):?>
                                                                <li>
                                                                    <a href="#" class="questionType" aria-data-value="<?php echo $type; ?>" <?php if($type == $eqrow['type']){echo 'active';}?>><?php echo $option;?></a>
                                                                </li>
                                                            <?php endforeach;?>    
                                                            
                                                            <li role="separator" class="divider"></li>
                                                        <?php endforeach;?>
                                                        
                                                    </ul>
                                                </div>
                                            <?php else: ?>
                                                <?php 
                                                    $aQtypeData=array();
                                                    foreach (getQuestionTypeList($eqrow['type'], 'array') as $key=> $questionType)
                                                    {
                                                        $aQtypeData[]=array('code'=>$key,'description'=>$questionType['description'],'group'=>$questionType['group']);
                                                    }
                                                    echo CHtml::dropDownList(
                                                                                'type',
                                                                                'category',
                                                                                CHtml::listData($aQtypeData,'code','description','group'),
                                                                                array(
                                                                                        'class' => 'none',
                                                                                        'id'=>'question_type',
                                                                                        'options' => array($eqrow['type']=>array('selected'=>true))
                                                                                     )
                                                                            );
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div  class="form-group">
                                            <label for='gid'><?php eT("Question group:"); ?></label>
                                            <select name='gid' id='gid' class="form-control">
                                                <?php echo getGroupList3($eqrow['gid'],$surveyid); ?>
                                            </select>
                                        </div>
                                        
                                        <div  class="form-group" id="OtherSelection">
                                            <label><?php eT("Option 'Other':"); ?></label>
                                            <?php if ($activated != "Y"): ?>
                                                <label for='OY'><?php eT("Yes"); ?></label><input id='OY' type='radio' class='radiobtn' name='other' value='Y'
                                                    <?php if ($eqrow['other'] == "Y") { ?>
                                                        checked
                                                        <?php } ?>
                                                    />&nbsp;&nbsp;
                                                <label for='ON'><?php eT("No"); ?></label><input id='ON' type='radio' class='radiobtn' name='other' value='N'
                                                    <?php if ($eqrow['other'] == "N" || $eqrow['other'] == "" ) { ?>
                                                        checked='checked'
                                                        <?php } ?>
                                                    />                                                
                                            <?php else:?>
                                                <?php eT("Cannot be changed (survey is active)");?>    
                                                <input type='hidden' name='other' value="<?php echo $eqrow['other']; ?>" />                                     
                                            <?php endif;?>
                                        </div>    
                                                         
                                        
                                
                                        <div id='MandatorySelection'  class="form-group">
                                            <label><?php eT("Mandatory:"); ?></label>
                                            <!--  'value'=>($eqrow['mandatory'] == "Y") -->
                                            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array('name' => 'mandatory', 'value'=> '0'  ));?>                                            
                                        </div>
                                        
                                        <div  class="form-group">
                                            <label for='relevance'><?php eT("Relevance equation:"); ?></label>
                                            <textarea  class="form-control" rows='1' id='relevance' name='relevance' ></textarea>
                                        </div>
                                        
                                        <div id='Validation'  class="form-group">
                                            <label for='preg'><?php eT("Validation:"); ?></label>
                                            <input type='text' id='preg' name='preg' size='50' value="<?php echo $eqrow['preg']; ?>" />
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php eT("Advanced settings"); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">

                                    
                                    <div id="advancedquestionsettingswrapper" >
                                        <div class="loader">
                                            <?php eT("Loading..."); ?>
                                        </div>
                                    
                                        <div id="advancedquestionsettings"> 
                                            <!-- Content append via ajax -->
                                        </div>
                                    </div>
                                    
                                    <br />
                                <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
            </div>			        
			        
			        	

                <?php if ($adding)
                    { ?>
                    <input type='hidden' name='action' value='insertquestion' />
                    <input type='hidden' name='gid' value='<?php echo $eqrow['gid']; ?>' />
                    <p><input type='submit' value='<?php eT("Add question"); ?>' />
                    <?php }
                    elseif ($copying)
                    { ?>
                    <input type='hidden' name='action' value='copyquestion' />
                    <input type='hidden' id='oldqid' name='oldqid' value='<?php echo $qid; ?>' />
                    <p><input type='submit' value='<?php eT("Copy question"); ?>' />
                    <?php }
                    else
                    { ?>
                    <input type='hidden' name='action' value='updatequestion' />
                    <input type='hidden' id='qid' name='qid' value='<?php echo $qid; ?>' />
                    <p><button type='submit' class="saveandreturn hidden" name="redirection" value="edit"><?php eT("Save") ?> </button>
                    <input type='submit'  class="hidden" value='<?php eT("Save and close"); ?>' />
                    <?php } ?>			        	
			        
			         <input type='hidden' id='sid' name='sid' value='<?php echo $surveyid; ?>' />	
			   </form>
			
			
			
			
			
			
		</div>
		<?php endif;?>
	</div>
</div>







