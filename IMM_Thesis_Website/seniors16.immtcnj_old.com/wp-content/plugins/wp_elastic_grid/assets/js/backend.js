jQuery(function() {
	jQuery.fn.exists = function(){return this.length>0;}

	if (jQuery('#file_upload').length > 0) {
		jQuery('#file_upload').uploadify({
			'formData'     : {
				'projectId' : uploadify.projectId,
				'upload_folder' : uploadify.upload_folder,
				'thumb_height' : uploadify.thumb_height,
				'thumb_width' : uploadify.thumb_width,
				'thumb_type' : uploadify.thumb_type,
				'resize_width' : uploadify.resize_width,
				'resize_height' : uploadify.resize_height,
				'resize_type' : uploadify.resize_type,
				'timestamp' : uploadify.timestamp,
				'token'     : uploadify.token
			},
			'swf'      : uploadify.pluginPath+'/uploadify/uploadify.swf',
			'uploader' : uploadify.pluginPath+'/uploadify/uploadify.php',
	 		'onQueueComplete' : function(file) {
	 			wp_egrid_load_project_photo('#project_photos');
	        }
		});
	}

	function wp_egrid_load_project_photo(response_container_id){
		jQuery(response_container_id).html('<img alt="loading..." src="'+uploadify.pluginPath+'/assets/img/loading.gif">');

        jQuery.ajax({
		        type:'POST',
		        data:{action:'wp_egrid_ajax_load_project_photo', 'project_id':uploadify.projectId},
		        url: uploadify.blogURL+"/wp-admin/admin-ajax.php",
		        success: function(value) {
		        	jQuery(response_container_id).parent().attr('style','border-bottom:solid 1px #D5D5D5');
		        	jQuery(response_container_id).html(value);
		        	jQuery(response_container_id).find('.delete_photo').bind('click', function(){
		        		if(confirm('Are you sure?')){
		     				photoAction.delete_photo(this);
		        		}
		       		});
		        	jQuery(response_container_id).find('.set_default_photo').bind('click', function(){
	     				photoAction.set_default_photo(this);
		       		});
            	}
        });

	}

	//photo action
	var photoAction = {
		delete_photo : function(obj){
			photo_id = jQuery(obj).data('id');
			filename = jQuery(obj).data('filename');
	        jQuery.ajax({
		            type:'POST',
		            data:{action:'wp_egrid_ajax_delete_photo', 'photo_id':photo_id, 'filename':filename},
		            url: uploadify.blogURL+"/wp-admin/admin-ajax.php",
		            success: function(value) {
            			jQuery(obj).parent().fadeOut(500);
            		}
            });
		},
		set_default_photo : function(obj){
			photo_id = jQuery(obj).val();
			projectid = jQuery(obj).data('projectid');
	        jQuery.ajax({
		            type:'POST',
		            data:{action:'wp_egrid_ajax_set_default_photo', 'photo_id':photo_id, 'project_id':projectid},
		            url: uploadify.blogURL+"/wp-admin/admin-ajax.php",
		            success: function(value) {
		            	console.log(value);
            		}
	        });
		}
	};

	//load uploaded photo
	if(jQuery('#project_photos').length > 0){
		wp_egrid_load_project_photo('#project_photos');
	}
});

jQuery(document).ready(function(){
	if(jQuery(".wp_egrid_project").length > 0){
	    jQuery(".wp_egrid_project").tableDnD({
	        dragHandle: "column-ordered",
	        onDrop: function(table, row) {
	            var rows = table.tBodies[0].rows;
	            var newOrder = [];
	            for (var i=0; i<rows.length; i++) {
	                newOrder[i] = jQuery(rows[i]).find('.project_id').val();
	            }
	            jQuery.ajax({
	                    type:'POST',
	                    data:{action:'wp_egrid_ajax_order_project', 'ordered': JSON.stringify(newOrder)},
	                    url: tablednd.blogURL+"/wp-admin/admin-ajax.php",
	                    success: function(value) {
	                        console.log(value)
	                    }
	            });
	        }
	    });
	}
});


jQuery(document).ready(function() {
	if(jQuery('#sheepItForm').length > 0){
	    cloneForm = jQuery.parseJSON(cloneForm);
	    var sheepItForm = jQuery('#sheepItForm').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: false,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 0,
	        data: cloneForm
	    });
   }

	if(jQuery('.tagsinput').length > 0){
		jQuery('.tagsinput').tagsInput({
		    'width':'600px'
		});
	}
});