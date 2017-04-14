<script type="text/javascript">

	Dropzone.autoDiscover = false;
	Dropzone.options.avatarDropzone = {
	  paramName: "file",
	  maxFilesize: 1,
	  addRemoveLinks: false,
	  dictMaxFilesExceeded: '',
	  acceptedFiles: '.jpeg, .jpg',
	  renameFilename: 'avatar.jpg',
	  headers: {
	    "Pragma": "no-cache"
	  },
	  clickable: true,
	  parallelUploads: 1,
	  accept: function(file, done) {
	    if (file.name == "justinbieber.jpg") {
	      done("Naha, you don't.");
	    } else {
	      $('.dz-message').text('Drop files here to upload').show();
	      done();
	    }
	  },
	  init: function() {
	    this.on("maxfilesexceeded", function(file) {});
	    this.on("uploadprogress", function(file) {
	      var html = '<div class="progress">';
	      html += '<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">';
	      html += '</div>';
	      html += '</div>';
	      $('.dz-message').html(html).show();
	    });
	    this.on("maxfilesreached", function(file) {});
	    this.on("complete", function(file) {
	      this.removeFile(file);
	    });
	    this.on("success", function(file, res) {
	      var html = '<div class="progress">';
	      html += '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">';
	      html += 'Upload Successful...';
	      html += '</div>';
	      html += '</div>';
	      $('.dz-message').html(html).show();
	      setTimeout(function() {
	        $('.dz-message').text('Drop files here to upload').show();
	      }, 2000);
	      $('#user_selected_avatar, .user-avatar-nav').attr('src', '/images/profile/{{ $user->id }}/avatar/avatar.jpg?' + new Date().getTime());
	    });
	    this.on("error", function(file, res) {
	      var html = '<div class="progress">';
	      html += '<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">';
	      html += 'Upload Failed...';
	      html += '</div>';
	      html += '</div>';
	      $('.dz-message').html(html).show();
	      setTimeout(function() {
	        $('.dz-message').text('Drop files here to upload').show();
	      }, 2000);
	    });
	  }
	};

	var avatarDropzone = new Dropzone("#avatarDropzone");

</script>