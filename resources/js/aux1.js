/**
 * PROFILE CREATION: UPLOADED IMAGE PREVIEW
 * 
 * admin/profiles/create.blade.php
 * src: https://www.tutsmake.com/laravel-8-image-upload-with-preview/
 */
$(document).ready(function (e) {
	$('#image_url').change(function(){
		let reader = new FileReader();
		reader.onload = (e) => { 
			$('#preview-image').attr('src', e.target.result);
		}	
		reader.readAsDataURL(this.files[0]);
	});
});

