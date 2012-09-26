<?php head(array('title' => item('Dublin Core', 'Title'), 'bodyid'=>'items','bodyclass' => 'show')); ?>

<div id="primary">

    <h1><?php echo item('Dublin Core', 'Title'); ?></h1>

    <!-- The following returns all of the files associated with an item. -->
    <div id="itemfiles" class="element">
        
        <div class="element-text">
            <?php
            require_once './././plugins/Scripto/libraries/Scripto.php';
            require_once './././application/helpers/Media.php';
            $scripto = ScriptoPlugin::getScripto();
            $helper = new Omeka_View_Helper_Media;
            $files =  return_files_for_item(array());           
            echo '<ul class="thumbnails">';
            foreach ($files as $file) {
                $status = $scripto->getPageTranscriptionStatus($file->id);
                 
                switch ($status) {
                case 'Completed':
                    $label = "label-important";
                    break;
                case 'Needs Review':
                    $label = "label-warning";
                    break;
                case 'Not Started':
                    $label = "label-success";
                    break;                
                default:
                    $label = "label-important";
                    break;
                } 

                 $fileTitle = $this->fileMetadata($file, 'Dublin Core', 'Title');
                 //using monospaced font to make this work
                 if (strlen($fileTitle) <= 18) {
                    $fileTitle .= '<br /><br /><br />';
                 } elseif (strlen($fileTitle) <= 36 ) {
                     $fileTitle .= '<br /><br />';
                 }
                 echo '   <li class="span2">';
                 echo '       <div class="thumbnail">';
                 echo '           <a href="http://diyhistory.lib.uiowa.edu/transcribe/scripto/transcribe/'.$file->item_id.'/'.$file->id.'"><img src="http://diyhistory.lib.uiowa.edu/transcribe/archive/square_thumbnails/' . $file->archive_filename . '" /></a>';
                 echo '           <h4>'.$fileTitle.'</h4>';
                 echo '           <span class="label '.$label.'">'.$status.'</span>';
                 echo '       </div>';
                 echo '   </li>';

            }

            echo '</ul>';

            ?>
        </div>
   

    </div>

    <!-- If the item belongs to a collection, the following creates a link to that collection. 
    <?php //if (item_belongs_to_collection()): ?>
    <div id="collection" class="element">
        <h3><?php //echo __('Collection'); ?></h3>
        <div class="element-text"><p><?php //echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php //endif; ?>
    -->

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (item_has_tags()): ?>
    <div id="item-tags" class="element">
        <h3><?php echo __('Tags'); ?></h3>
        <div class="element-text"><?php echo item_tags_as_string(); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. 
    <div id="item-citation" class="element">
        <h3><?php //echo __('Citation'); ?></h3>
        <div class="element-text"><?php //echo item_citation(); ?></div>
    </div>
    -->

    <?php //echo plugin_append_to_items_show(); ?>

    
</div><!-- end primary -->


