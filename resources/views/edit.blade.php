<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel - Category & Sub-Category By BIBEK</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel='stylesheet' href="{{ url('/') }}/assets/css/bootstrap.min.css" />      
        <link rel='stylesheet' href="{{ url('/') }}/assets/css/style.css" />      
    </head>
    <body>
        <div class="side-navigation">
            <ul>
                <li class="category">Category
                    <ul>
                        <li class="sub-category">Sub-Category</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="work-space">
           <div class="row">
               <a href="{{ url('/') }}" style="margin-bottom: 30px" class="btn btn-primary btn-sm">Home</a>
               <div class="col-md-12">
                    @if ($errorMsg = session('errorMsg'))
                    <label class="alert alert-danger btn-block text-center">
                        {{ $errorMsg }}
                    </label>
                    @endif
                    @if ($resMsg = session('resMsg'))
                    <label class="alert alert-success btn-block text-center">
                        {{ $resMsg }}
                    </label>
                    @endif

                    @if($meta == 'category')
                    <br>
                    <div class="card card-body">
                        <h5>Add New Category</h5>
                        <form action="{{ url('/') }}/category/update" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}" />
                                    <input type="text" name="category_name" value="{{ $category->title ?? '' }}" class="form-control form-control-sm" placeholder="Enter Category Name ...">
                                    @if ($errors->has('category_name'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-danger btn-sm ">Update Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    @elseif($meta == 'subcategory')
                    <div class="card card-body">
                        <h5>Add New Sub-Category</h5>
                        <form action="{{ url('/') }}/subcategory/update" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="category_id" value="{{ $subcat->sub_id ?? '' }}" class="form-control form-control-sm" >
                                    <!-- <select name="category_id" class="form-control form-control-sm">
                                        @php
                                            $i = 0;
                                            $categories = \App\Category::where('is_deleted', 0)->where('sub_id', '<', '1')->get();
                                        @endphp
                                        <option value=""> 
                                            --- Selete Category
                                        </option>
                                        @forelse($categories as $row)
                                            <option value="{{ $row->id ?? '' }}" @if($subcat->sub_id == $row->id) selected @endif>{{ ucwords($row->title) ?? '' }}</option>
                                        @empty 

                                        @endforelse
                                    </select> -->
                                    @if ($errors->has('category_id'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('category_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="subcat_id" value="{{ $subcat->sub_id ?? '' }}" />
                                    <input type="text" name="subcategory_name" value="{{ $subcat->title ?? '' }}" class="form-control form-control-sm" placeholder="Enter Sub Category Name ...">
                                    @if ($errors->has('subcategory_name'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('subcategory_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm ">Insert Sub-Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    @else
                    
                    @endif
               </div>
           </div>
        </div>
        <script>
        </script>
    </body>
</html>
