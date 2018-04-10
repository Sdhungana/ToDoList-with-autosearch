<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap font-awesome-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  </head>
  <body>
      <br>

      <div class="container">
          <div class="row ">
              <div class="col-md-5 offset-md-1" >
                    <div class="card">
                      <div class="card-header" >
                         <h4> Ajax To-Do-List <a href="#" class="pull-right" id="addNew" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a></h4>
                      </div>
                      <div class="card-body" >
                          <div class="list-group" id="itemBody">
                            @if(count($datas) == 0)
                            No items available
                            @else
                            @foreach($datas as $data)   
                              <a href="#" class="list-group-item list-group-item-action ourItem" data-toggle="modal" data-target="#exampleModal">{{$data->items}}
                              <input type="hidden" id="itemId" value="{{$data->id}}"></a>
                            @endforeach
                              @endif
                          </div>
                      </div>
                  </div>  
              </div>
              <div class="col-md-5 offset-md-1" >
                  {{--  <form class="form-inline my-2 my-lg-0">  --}}
                      <input class="form-control mr-sm-2" type="search"   id="searchTag" placeholder="Search" aria-label="Search">
                      {{--  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>  --}}
                    {{--  </form>      --}}
          </div>
          </div>
      </div>

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Add New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id">
        <input type="text" placeholder="Write your text here" id="addItem" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display:none">Delete</button>
        <button type="button" class="btn btn-success" id="saveChanges" data-dismiss="modal" style="display:none">Save changes</button>
        <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
      </div>
    </div>
  </div>
</div>
{{csrf_field()}}
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Custom jQuery -->
    <script>
        $(document).ready(function(){
          $(document).on('click','.ourItem',function(){
           var text = $(this).text();
           var text = $.trim(text);
           var id = $(this).find('#itemId').val();
            $('#addItem').val(text);
            $('#title').text('Edit Item');
            $('#delete').show();
            $('#saveChanges').show();
            $('#addButton').hide();
             $('#id').val(id); 
          });
          $(document).on('click','#addNew',function(){
            $('#addItem').val('');
             $('#title').text('Add New Item');
             $('#delete').hide();
             $('#saveChanges').hide();
             $('#addButton').show();         
           });
           $('#addButton').click(function(){
             var text = $('#addItem').val();
             if(text == ""){
               alert('Please enter some text !!');
             }else{
              $.post('insert',{'text':text,'_token':$('input[name=_token]').val()});
              $('#itemBody').load(location.href + ' #itemBody');  
             }
            });
              
            $('#delete').click(function(){
              var id = $('#id').val();
              $.post('delete',{'id':id, '_token':$('input[name=_token]').val()});
              $('#itemBody').load(location.href + ' #itemBody');
            }); 
            $('#saveChanges').click(function(){
              var text = $('#addItem').val();
              var id = $('#id').val();
               $.post('update',{'text':text,'id':id,'_token':$('input[name=_token]').val()});
                 $('#itemBody').load(location.href + ' #itemBody');
              });  
              $( function() {
                $( "#searchTag" ).autocomplete({
                  source: 'http://todolist.test/search'
                });
              } );  
        });
    </script>
</body>
</html>