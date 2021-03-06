<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>NTS- Code Assignment</title>

    <style type="text/css">
      
      .loading {
    left: 0;
    right: 0;
    min-height: 100px;
    top: 0px;
    bottom: 0px;
    z-index: 10000;
    position: absolute;
    background-color: rgba(255,255,255,0.7);
    background-image: url(  loading.gif);
    background-repeat: no-repeat;
    background-position: center;
}
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3" >
          <h3><strong>NTS Problem Statement</strong></h3>

        </div>
        <div class="row col-md-6 col-md-offset-3" id="ntsfileupload" style="margin:20%">



          <p class="text-success success"></p>
          <p class="text-danger error"></p>
           <form class="form-inline"  method="POST"  enctype="multipart/form-data">
            <label for="Media Upload" ><strong>Choose File:</strong></label>
            <div class="form-group">
              <input class="form-control" type="file" name="filename" id="file">
              <input class="btn btn-success" id="fileuploadsubmit" type="button" value="submit">
            </div>

            
        </form>
        </div>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <script type="text/javascript">
      
      $(document).ready(function(){

        _this = this;

          ///Getting current URL path
         var thispath = document.location.pathname;
               thispath = thispath.substring(0,thispath.lastIndexOf("/"));
               thispath = thispath.substring(0,thispath.lastIndexOf("/"));
               console.log(thispath);
               _this.apipath = thispath;

              console.log(_this.apipath);

        $("body").on("click","#fileuploadsubmit",function(){
        showLoadingDiv("#ntsfileupload");
        $("p.success").html("");
        $("p.error").html("");
        console.log($("#file").get(0).files[0]);
        var data = $("#file").get(0).files[0];

        if(data == "" || data == null)
        {
            stopLoadingDiv("#ntsfileupload");
            $("p.error").html("Please choose a media file");
            setInterval(function(){ $("p.error").html("");$("#file").val("");}, 3000);
            return false;
        }
        console.log(data);
        var formdata=new FormData();
        formdata.append("filename",data);
         
        $.ajax({
        type:"POST",
        url:_this.apipath+"/api/fileupload.php",
        data:formdata,
        contentType:false,
        processData:false,
        success:function(data){
          console.log(data);
          if(!data.error)
          {
            stopLoadingDiv("#ntsfileupload");
            $("p.success").html("Successfully file uploaded to S3 bucket");
            setInterval(function(){ $("p.success").html(""); $("#file").val("");}, 3000);
          }
          else
          {
            stopLoadingDiv("#ntsfileupload");
            $("p.error").html(data.error);
            setInterval(function(){ $("p.error").html("");$("#file").val("");}, 3000);
          }
        },
        error:function(data){
          stopLoadingDiv("#ntsfileupload");
          console.log(data);
           $("p.error").html(data.error);
          setInterval(function(){ $("p.error").html(""); $("#file").val("");}, 3000);
        }
      });
        
      });

    function showLoadingDiv(id)
    {
      $(id).children().css({"opacity":"0"});
      $(id).append("<div class='loading'></div>");
    }

    function stopLoadingDiv(id)
    {
      $(id).children().css({"opacity":"1"});
      $(id+" .loading").remove();
    }


     });



    </script>
  </body>
</html>