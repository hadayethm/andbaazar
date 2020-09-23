
@extends('merchant.master')
@section('content')
@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
{{-- <link href="{{ asset('material') }}/css/select2.min.css" rel="stylesheet" /> --}}


<style>
    #catarea{
            background: #fff;
            border: 1px solid #ddd;
            width: 97%;
        }
        .cat-level ul li {
            display: inherit;
            padding: 5px;
            cursor: pointer;
            border-left: 2px solid #fff;
            margin: 2px;
        }
        .cat-level ul li:hover,.active{
            background: #ddd;
            border-left: 2px solid red !important;
        }
        .cat-level{
            border: 1px solid #ddd;
        }
        .cat-levels{
            height: 250px;
            overflow-y: scroll;
        }
        .cat-level input[type=text]{
            height: 40px;
        }
        .foo {
            position: absolute;
            background-color: white;
            width: 5em;
            z-index: 100;
        }
        .scroll {
            overflow-x: auto;
        }
        .readonly {
            opacity: .5;
            cursor: not-allowed !important;
        }

       /* Iamge */
       .h-100{
            height: 100px !important;
            margin: 4px;
        }
        .drop-area{
            display: flex;
            padding: 10px;
            background: #fdfbfb;
            cursor: pointer;
            border: 2px dashed #ddd !important
        }
        .drop-single{
            border: 1px solid #ddd;
            padding: 5px;
            margin: 5px;
            background: #fff;
            cursor: move;
        }
        .dz-message{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dz-message h2{
            color: #b7b0b0;
            font-weight: 1000;
            font-size: 24px;
        }
        .collpanel{
            /* width: 672px; */
            width:100%;
            height: 250px;
        }
        input[type=text],input[type=number],select,.input-group-text,.h-40{
            height: 40px !important;
        }

        }
        .rowRemove{
            line-height: 26px;
        }
        .ui-sortable-placeholder { height: 125px; width: 125px; border: 1px dashed; line-height: 1.2em; }

        /* button */
        .custom{
          width: 108px;
          height:50px;
        } 
        .multepale-select{
            padding-bottom: 100px!important;
        } 
</style>

@endpush
@include('elements.alert')


<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='krishi'])
            <div class="col-md-9">
                <h3>Add Krishi Product</h3>
                 <div class="card mb-4">
                    <h5 class="card-header">Krishi information</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                            <form action="{{route('krishiproductstore')}}" method="POST"  class="form" id="validateForm" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" class="form-control" name="name" value="{{ old('name',$krishiproduct->name) }}" id="name" />
                                            <span class="text-danger" id="message_name"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>  
                                </div>
                                {{-- <div class="form-group">
                                    <label for="name">Category Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('name') }}</span>
                                    <input type="text" readonly class="form-control @error('category') border-danger @enderror" required name="category" value="{{ old('name') }}" id="category" placeholder="Category">
                                    <span class="text-danger" id="message_category"></span>
                                    <input type="hidden" name="category_id" id="category_id">
                                    <div class="position-absolute foo p-3" id="catarea" style="display: none">
                                        <div class="categories search-area d-flex scroll border">
                                            <div class="col-md-3 cat-level p-2 level-1">
                                                <input type="text" class="form-control" onkeyup="categorySearch(1,this)" placeholder="search">
                                                <ul class="cat-levels" id="">
                                                    @foreach ($categories as $row)
                                                    <li onclick="getNextLevel({{$row->id}},1,this)" value="{{ $row->id }}">{{$row->name}} <span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cat-footer p-2">
                                            <p>Current Selection : <span class="currentSelection font-weight-bold"></span></p>
                                            <span class="btn btn-sm btn-info m-1 readonly" id="confirm" data-category="" >Confirm</span>
                                            <span class="btn btn-sm btn-warning m-1" id="close">Close</span>
                                            <span class="btn btn-sm btn-danger m-1" id="clear">Clear</span>
                                        </div>
                                    </div>
                                </div>  --}}
                                <div class="form-group">
                                    <label for="color_id" class="col-xl-3 col-md-4"></label>
                                    <div id="dropzone-main" class="img-upload-area" data-color="main"><label class="mt-3"><b>Images :</b><span class="text-danger" id="message_main_img"></span></label>
                                        <div class="border m-0 collpanel drop-area row my-awesome-dropzone-main" id="sortable-main">
                                            <span class="dz-message color-main">
                                                <h2>Drag & Drop Your Files</h2>
                                            </span>
                                        </div>
                                        <small>Remember Your featured file will be the first one.</small><br>
                                    </div>
                                    <div class="inputs"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group margin">
                                            <label for="date">Product add Date<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('date') }}</span>
                                            <input type="text"  class="form-control inputfield  @error('date') border-danger @enderror datepickerPreviousOnly" required name="date" value="{{ old('date',$krishiproduct->date) }}"   id="" placeholder="YYYY/MM/DD" autocomplete="off">
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group margin">
                                            <label class="video_url">Video Url</label>
                                            <input type="url" class="form-control" name="video_url" id="video_url" value="{{old('video_url',$krishiproduct->video_url)}}" />
                                            @if ($errors->has('video_url'))
                                            <span class="text-danger">{{ $errors->first('video_url') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="">Description<span class="text-danger"> *</span></label>
                                    <textarea class="form-control summernote" id="description" name="description">{{$krishiproduct->description}}</textarea>
                                    <span class="text-danger" id="message_description"></span>
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frequency">Frequency</label>
                                        <select class="form-control js-example-basic-multiple" name="frequency[]" multiple="multiple">
                                            <option value="">Select product frequency</option> 
                                            {{-- <option {{(old('location') == "Room A1" || in_array("Room A1", $selectedLocations) ? 'selected' : ''}}  value="Room A1">Room A1</option>
                                            <option {{old('location',$project->location) == "Room A1" ? 'selected' : ''}}  value="Room A1">Room A1</option> --}}
                                            
                                            <option {{ (old('frequency') == 'Sunday' || in_array('Sunday',$frequencyname) ? 'selected' : '') }} value="Sunday">Sunday</option>
                                            
                                            {{-- <option {{old('frequency', )}} --}}
                                            {{-- <option value="{{old('frequency',$frequencyname->frequency) == 'sunday' ? 'selected' : ''}}">Sunday</option> --}}
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednessday">Wednessday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                            <option value="everyday">Everyday</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="fortnightly">Fortnightly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>                    
                </div>
                <button class="btn btn-success custom float-right ml-2 w-5"  type="submit">Save</button> 
            </form> 
            </div>          
        </div>   
                 
    </div>  
</section>
@endsection
@push('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
{{-- <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> --}}
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
{{-- <script src="{{ asset('material') }}/js/select2.min.js"></script> --}}

    <script>
         $('#category').click(function(){
            $('#catarea').toggle();
        });
        $('#close').click(function(){
            $('#catarea').hide();
        });

        function getNextLevel(val,level,e){
            $('#confirm').addClass('readonly');
            $('#confirm').attr('onclick','ConfirmCategory(0,this)');
            var nextLevel = level+1;
            var li ='';
            $.ajax({
                type:"get",
                url:"{{ url('/merchant/e-commerce/products/subCategoryChild/{id}') }}",
                data:{ 'subCatId': val },
                success:function(data){
                        li += `<div class="col-md-3 cat-level p-2 level-${nextLevel}">
                                    <input type="text" onkeyup="categorySearch(${nextLevel},this)" class="form-control" placeholder="search">
                                    <ul class="cat-levels sub">`;
                    for( var i=0; i<data.length; i++ ){
                        if(data[i].is_last == 1){
                            li += `<li onclick="setConfirm(${data[i].id},${nextLevel},this)">${data[i].name}</li>`;
                        }else{
                            li += `<li onclick="getNextLevel(${data[i].id},${nextLevel},this)">${data[i].name}<span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>`;
                        }
                    }
                        li +=`</ul>
                                </div>`;

                    setActive(level,e);
                    $('.categories').append(li);
                    var far = $('.categories' ).width();
                    $('.categories').animate({scrollLeft:far},800);
                }
            })
        };

        function setConfirm(id,level,e){
            setActive(level,e);
            $('#confirm').attr('onclick','ConfirmCategory('+id+',this)');
            $('#confirm').removeClass('readonly');
        }

        function ConfirmCategory(id,e){
            if(id <= 0){
                alert('please select a category properly');
            }else{
                $('#category_id').val(id);
                $('#category').val($('.currentSelection').text());
                $('#catarea').hide();
                getCategoryAttr(id);
                getInventoryAttr(id);
                getBrands(id);
            }
        }
       
        function setActive(level,e){
            var current = '';
            for(var j = level+1; j<10 ; j++){
                $('.level-'+j).remove();
            }

            $('.col-md-3.cat-level.p-2.level-'+level+' ul li').each(function(){
                $(this).removeClass('active');
            })

            $(e).addClass('active');
            $('.col-md-3.cat-level.p-2 ul li.active').each(function(){
                current += $(this).text()+'/';
            })
            $('.currentSelection').html(current);

        }

        $('#clear').on('click',function(){
            for(var j = 2; j<10 ; j++){
                $('.level-'+j).remove();
            }
        });


        //search
        function categorySearch(level,e){

            var value = $(e).val();
            var patt = new RegExp(value, "i");

            $('.col-md-3.cat-level.p-2.level-'+level).find('li').each(function() {
                if($(this).text().search(patt) >= 0){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });

        }; 

        $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
// $('.js-example-basic-single').select2();

    </script>

    {{-- Summer Note --}}
    <script>
        $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });
    </script>
  {{-- Image --}}
    <script>
        //Rendering Main images into Dropzone
        $( "#sortable-main" ).sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });
        $("#sortable-main").disableSelection();
        // setup("my-awesome-dropzone-main",'main');
        var mockFile = [];
        @foreach($itemImages['main'] as $img)
            mockFiles = {
                name:'img-'+'{{$img->color_slug}}',
                size:{{$img->id}},
                dataURL: "{{asset('/')}}"+"{{$img->org_img}}"
            }
            mockFile.push(mockFiles);
        @endforeach
        setup("my-awesome-dropzone-main",'main',mockFile);

        //Rendering Other images into Dropzone
        @foreach($itemImages as $color=>$imges)
        mockFile = [];

        @foreach($imges as $img)
            mockFiles = {
                name:'img-'+'{{$img->color_slug}}',
                size:{{$img->id}},
                dataURL: "{{asset('/')}}"+"{{$img->org_img}}"
            }
            mockFile.push(mockFiles);
        @endforeach
        @if($color != 'main')
            appendDrops('{{$color}}',mockFile);
            mockFile = [];
        @endif
        @endforeach

        //Drug & Drop script start
        $( "#sortable-red").sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });

        //dropzone scripts
        $('#selectColor').change(function(){
            var flag = 0;
            var color = $(this).val();
            $('.img-upload-area').each(function(){
                if(color == $(this).data('color')){
                    flag = 1;
                }
            });
            if(flag == 0){
                appendDrops(color);
            }else{
                swal("The selected color already been exits", {icon: "warning",buttons: false,timer: 2000});
            }
        });
        function appendDrops(color,mockFile=''){
            $('.drops').append(
                    `<div id="dropzone-${color}" class="img-upload-area" data-color="${color}"><label class="mt-3">Color Family: <b>${color}</b></label>
                    <span class="btn btn-sm text-danger" onclick="removeColorItem('${color}')"><i class="fa fa-trash"></i></span>
                    <div class="border m-0 collpanel drop-area row my-awesome-dropzone${color}" id="sortable-${color}">
                        <span class="dz-message color-${color}">
                            <h2>Drag & Drop Your Files</h2>
                        </span>
                    </div>
                    <small>Remember Your featured file will be the first one.</small><br></div>`
                );
                $( "#sortable-"+color ).sortable({
                    placeholder: "ui-state-highlight",
                    revert: true,
                });
                $("#sortable-"+color ).disableSelection();
                setup("my-awesome-dropzone"+color,color,mockFile);
                inventoryRows(color);
        }

        Dropzone.autoDiscover = false;

        
        //function
        function setup(id,color,mockFile='') {
            let options = {
                autoProcessQueue: false,
                url : '/',
                thumbnailHeight: 200,
                thumbnailWidth: 300,
                maxFilesize: 100,
                maxFiles: 5,
                dictResponseError: "Server not Configured",
                dictFileTooBig: "File too big. Must be less than ",
                dictCancelUpload: "",
                acceptedFiles: ".png,.jpg,.jpeg",
                init: function() {

                    var self = this;

                    // self.on("addedfile", function(file) {
                    //     $('.color-'+color).addClass('d-none');
                    // });

                    self.on("dragenter", function(event) {
                        $('#sortable-'+color).css('background-color','#fff');
                    });
                    self.on("dragleave", function(event) {});

                    self.on("thumbnail", function(file){
                        // console.log(file);
                        var i = 0;
                        $('.color-'+color+'-element').each(function(){
                            i = i+1;
                        });
                        if(i > 5){
                            swal("Maximum Five file are allowed", {icon: "warning",buttons: false,timer: 2000});
                            this.removeFile(file);
                            $('#id'+file.size).remove();
                        }

                        if(file.size < 3000000){
                            $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" id="id${file.size}" value="${file.dataURL}">`);
                        }else{
                            swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                            this.removeFile(file);
                        }
                    });

                    self.on("removedfile", function(file) {
                        var i = 0;
                        $('.color-'+color+'-element').each(function(){
                            i = i+1;
                        });
                        if(i === 0){
                            $('.color-'+color).removeClass('d-none');
                        }
                        $('#id'+file.size).remove();
                    });

                    // Send file starts
                    self.on("sending", function(file) {
                        // console.log("upload started", file);
                    });

                    self.on("complete", function(file, response) {
                        if (file.name !== "442343.jpg") {
                            //this.removeFile(file);
                        }
                    });

                    self.on("maxFilesize", function(file, response) {
                        swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                        this.removeFile(file);
                    });

                    self.on("maxfilesexceeded", function(file, response) {
                        swal("Maximum file reached", {icon: "warning",buttons: false,timer: 2000});
                        this.removeFile(file);
                    });

                    self.on("addedfile", function(file) {
                        const pattern = /\d{6}(\.)(jpg|jpeg|png)/;
                        if (!pattern.test(file.name)) {
                            //   this.removeFile(file);
                        }
                    });


                    // Create the mock file:
                    // var mockFile = [
                    //     { name: "Filename", size: 12345 , dataURL:"http://localhost/andbaazar/public/uploads/shops/logos/shop-4.png"},
                    //     { name: "Filename", size: 12345 , dataURL:"http://localhost/andbaazar/public/uploads/shops/logos/shop-4.png"}
                    // ];

                    if(mockFile != ''){
                        mockFile.forEach(mockFile=>{
                            self.emit("addedfile", mockFile);
                            self.emit("thumbnail", mockFile, mockFile.dataURL);
                        });
                    }

                },

                previewTemplate: `
                <div class="drop-single color-${color}-element ui-state-default">
                <a href="javascript:undefined;" data-dz-remove=""><i class="fa fa-trash-o"></i>&nbsp;<span>Remove</span></a>
                <br/>
                <span class="dz-upload" data-dz-uploadprogress></span>
                <img class="h-100" data-dz-thumbnail/>
                </div>`
            };
            var myDropzone = new Dropzone(`.${id}`, options);
        }
    </script>
@endpush





