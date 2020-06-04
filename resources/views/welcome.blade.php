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
                <li class="category"> Bibek Das</li>
            </ul>
            <ul>
                @php
                    $i = 0;
                    $categories = \App\Category::where('is_deleted', 0)->where('sub_id', '<', '1')->get();
                @endphp
                @forelse($categories as $row)
                <li class="category">{{ ucwords($row->title) ?? '' }}
                    @php
                        $subCategories = \App\Category::where('is_deleted', 0)->where('sub_id', $row->id)->get();
                    @endphp
                    @forelse($subCategories as $scat)
                    <ul>
                        <li class="sub-category">{{ ucwords($scat->title) ?? '' }}</li>
                    </ul>
                    @empty 
                    @endforelse
                </li>
                @empty 
                <ul>
                    <li class="sub-category">No List(s)</li>
                </ul>
                @endforelse
            </ul>
        </div>
        <div class="work-space">


           <div class="row">
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



                    <div class="row">
                        <div class="col-md-6">
                            <h3>Category List</h3>
                            <ul id="tree1">
                                @foreach(\App\Category::where('sub_id', '<', '1')->get() as $category)
                                    <li>
                                        {{ $category->title }}
                                        @if(count($category->childs))
                                            @include('manageChild',['childs' => $category->childs])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card card-body">
                        <h5>Add New Category</h5>
                        <form action="{{ url('/') }}/category/create" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="parent_id " class="form-control form-control-sm" placeholder="category id">
                                    @if ($errors->has('category_name'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="category_name" class="form-control form-control-sm" placeholder="Enter Category Name ...">
                                    @if ($errors->has('category_name'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm ">Insert Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <!-- <div class="card card-body">
                        <h5>Add New Sub-Category</h5>
                        <form action="{{ url('/') }}/subcategory/create" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="category_id" class="form-control form-control-sm">
                                        <option value=""> 
                                            --- Selete Category
                                        </option>
                                        @forelse($categories as $row)
                                            <option value="{{ $row->id ?? '' }}">{{ ucwords($row->title) ?? '' }}</option>
                                        @empty 

                                        @endforelse
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('category_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="subcategory_name" class="form-control form-control-sm" placeholder="Enter Sub Category Name ...">
                                    @if ($errors->has('subcategory_name'))
                                        <p style="color:red; font-wieght:400;">{{ $errors->first('subcategory_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm ">Insert Sub-Category</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                    <br>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <h5>Categories List</h5>
                                <table class="table table-sm table-bodered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $row)
                                        @php
                                            $i++;
                                        @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ ucwords($row->title) ?? '' }}</td>
                                                <td>{{ date('D-m-Y | h:i:a', strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/') }}/category/edit/{{ $row->id }}" class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ url('/') }}/category/delete" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="did" value="{{ $row->id }}" />
                                                        <button type="submit"  class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty 
                                            <tr>
                                                <td>No Category(s) Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-body">
                                <h5>All Categories List</h5>
                                <table class="table table-sm table-bodered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $j = 0;
                                            $subcategories = \App\Category::where('is_deleted', 0)->where('sub_id', '!=', '')->get();
                                        @endphp
                                        @forelse($subcategories as $row)
                                        @php
                                            $j++;
                                        @endphp
                                            <tr>
                                                <td>{{ $j }}</td>
                                                <td>{{ ucwords($row->title) ?? '' }}</td>
                                                <td>{{ date('D-m-Y | h:i:a', strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/') }}/subcategory/edit/{{ $row->sub_id }}" class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ url('/') }}/subcategory/delete" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="did" value="{{ $row->id }}" />
                                                        <button type="submit"  class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty 
                                            <tr>
                                                <td>No Category(s) Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
               </div>
           </div>
        </div>
        <script>
        </script>
    </body>
</html>
