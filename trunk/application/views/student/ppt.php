<?php

    $result = $this->lectures_model->getLectureResources($lectureID);

    echo '
		<object id="presentation" width="520px" height="330px" 
            classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" align="middle">
            <param name="allowScriptAccess" value="sameDomain" />
            <param name="movie" value="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf" />
            <param name="quality" value="high" />
            <param name="bgcolor" value="#ffffff" />
            <param name="allowFullScreen" value="true" />
            <embed src="'.base_url().'resources/Neurosurgery Review Course 2009/Introduction/'.$i->resourceTitle.'.swf" quality="high" bgcolor="#ffffff" width="520px" height="330px" name="presentation" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" allowFullScreen="true" />
        </object>
        <a href="'.$i->resourceLocation.'">'.$i->resourceTitle.'.'.$i->resourceType.'</a>
    ';
                
?>
