@extends('layouts.master')
@section('content')
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                swal("Done!", '{{Session('success')}}', "success");
            });
        </script>
    @endif
    <div class="user-profile user-card mb-4">
        <div class="card-header border-0 p-0 pb-0">
            <div class="cover-img-block">
                <img src="assets/images/profile/cover.jpg" alt="" class="img-fluid">
                <div class="overlay"></div>
            </div>
        </div>
        <div class="card-body py-0">
            <div class="user-about-block m-0">
                <div class="row">
                    <div class="col-md-4 text-center mt-n5">
                        <div class="change-profile text-center">
                            <div class="dropdown w-auto d-inline-block">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="profile-dp">
                                        <div class="position-relative d-inline-block">
                                            @if(auth()->user()->profile)
                                                <img class="img-radius img-fluid wid-100" src="{{Storage::disk('local')->url('/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}">
                                            @else
                                                <img class="img-radius img-fluid wid-100" src="{{url('img/profile.png')}}">
                                            @endif
                                        </div>
                                        <div class="overlay">
                                            <span>change</span>
                                        </div>
                                    </div>
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-shield mr-2"></i>Protact</a>
                                    <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-1">{{auth()->user()->fname}} {{auth()->user()->lname}}</h5>
                        <p class="mb-2 text-muted">{{auth()->user()->roles->name}}</p>
                    </div>
                    <div class="col-md-8 mt-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="www.aimscal.com" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-globe mr-2 f-18"></i>www.aimscal.com</a>
                                <div class="clearfix"></div>
                                <a href class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>{{auth()->user()->email}}</a>
                                <div class="clearfix"></div>
                                <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone mr-2 f-18"></i>{{auth()->user()->phone}}</a>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->address}}
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="feather icon-briefcase mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->departments->name}}
                                        </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="feather icon-more-horizontal mr-2 mt-1 f-18"></i>
                                    <div class="media-body text-left">
                                        <p class="mb-0 text-muted">
                                            {{auth()->user()->designations->name}}
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-reset active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-home mr-2"></i>Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-reset" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather icon-user mr-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-reset" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="feather icon-phone mr-2"></i>My Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-reset" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false"><i class="feather icon-image mr-2"></i>Gallery</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- profile header end -->

    <!-- profile body start -->
    <div class="row">
        <div class="col-md-8 order-md-2">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-normal"><a href="#!" class="text-h-primary text-reset"><b class="font-weight-bolder">Josephin Doe</b></a> posted on your timeline</h5>
                            <p class="mb-0 text-muted">50 minutes ago</p>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
														Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="#!"><img src="assets/images/profile/bg-1.jpg" alt="" class="img-fluid"></a>
                        <div class="card-body">
                            <a href="#!" class="text-h-primary">
                                <h6>The new Lorem Ipsum is simply</h6>
                            </a>
                            <p class="text-muted mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="card-body border-top border-bottom">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item"><a href="#!" class="text-danger text-h-danger"><i class="feather icon-heart-on mr-2"></i>Like</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-message-square mr-2"></i>Comment</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-share-2 mr-2"></i>Share</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between mb-4">
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">Comment (50)</a></div>
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">See All</a></div>
                            </div>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-30 align-top m-r-15">
                                <div class="media-body">
                                    <a href="#!">
                                        <h6 class="mb-0 text-h-primary">Alex Thompson</h6>
                                    </a>
                                    <p class="m-b-0">Looking Very nice type and scrambled
                                        <a href="#!" class="text-muted text-h-danger ml-1"><small>Like</small></a>
                                        <a href="#!" class="text-muted text-h-primary ml-1"><small>Comment</small></a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-30 align-top m-r-15">
                                <div class="media-body">
                                    <a href="#!">
                                        <h6 class="mb-0 text-h-primary">Alex Thompson</h6>
                                    </a>
                                    <p class="m-b-0">Nice Pic printing and typesetting industry
                                        <a href="#!" class="text-muted text-h-danger ml-1"><small>Like</small></a>
                                        <a href="#!" class="text-muted text-h-primary ml-1"><small>Comment</small></a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                <div class="media-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control border-0 shadow-none px-0" placeholder="Write comment hear !. . .">
                                        <div class="input-group-append">
                                            <button class="btn  btn-primary" type="button"><i class="feather icon-message-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-normal"><a href="#!" class="text-h-primary text-reset"><b class="font-weight-bolder">Josephin Doe</b></a> posted on your timeline</h5>
                            <p class="mb-0 text-muted">50 minutes ago</p>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
														Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="#!"><img src="assets/images/profile/bg-2.jpg" alt="" class="img-fluid"></a>
                        <div class="card-body">
                            <a href="#!" class="text-h-primary">
                                <h6>The new Lorem Ipsum is simply</h6>
                            </a>
                            <p class="text-muted mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="card-body border-top border-bottom">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-danger"><i class="feather icon-heart mr-2"></i>Like</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-message-square mr-2"></i>Comment</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-share-2 mr-2"></i>Share</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between mb-4">
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">Comment (50)</a></div>
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">See All</a></div>
                            </div>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-30 align-top m-r-15">
                                <div class="media-body">
                                    <a href="#!">
                                        <h6 class="mb-0 text-h-primary">Alex Thompson</h6>
                                    </a>
                                    <p class="m-b-0">Looking Very nice type and scrambled
                                        <a href="#!" class="text-muted text-h-danger ml-1"><small>Like</small></a>
                                        <a href="#!" class="text-muted text-h-primary ml-1"><small>Comment</small></a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                <div class="media-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control border-0 shadow-none px-0" placeholder="Write comment hear !. . .">
                                        <div class="input-group-append">
                                            <button class="btn  btn-primary" type="button"><i class="feather icon-message-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-normal"><a href="#!" class="text-h-primary text-reset"><b class="font-weight-bolder">Josephin Doe</b></a> posted on your timeline</h5>
                            <p class="mb-0 text-muted">50 minutes ago</p>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
														Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                                        </li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="#!"><img src="assets/images/profile/bg-3.jpg" alt="" class="img-fluid"></a>
                        <div class="card-body">
                            <a href="#!" class="text-h-primary">
                                <h6>The new Lorem Ipsum is simply</h6>
                            </a>
                            <p class="text-muted mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="card-body border-top border-bottom">
                            <ul class="list-inline m-0">
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-danger"><i class="feather icon-heart mr-2"></i>Like</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-message-square mr-2"></i>Comment</a></li>
                                <li class="list-inline-item"><a href="#!" class="text-muted text-h-primary"><i class="feather icon-share-2 mr-2"></i>Share</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between mb-4">
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">Comment (0)</a></div>
                                <div class="col-auto"><a href="#!" class="text-muted text-h-primary">See All</a></div>
                            </div>
                            <div class="media mb-0">
                                <img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                <div class="media-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control border-0 shadow-none px-0" placeholder="Write comment hear !. . .">
                                        <div class="input-group-append">
                                            <button class="btn  btn-primary" type="button"><i class="feather icon-message-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Personal details</h5>
                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                <i class="feather icon-edit"></i>
                            </button>
                        </div>
                        <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                    <div class="col-sm-9">
                                        Lary Doe
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
                                    <div class="col-sm-9">
                                        Male
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                                    <div class="col-sm-9">
                                        16-12-1994
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Martail Status</label>
                                    <div class="col-sm-9">
                                        Unmarried
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                                    <div class="col-sm-9">
                                        <p class="mb-0 text-muted">4289 Calvin Street</p>
                                        <p class="mb-0 text-muted">Baltimore, near MD Tower Maryland,</p>
                                        <p class="mb-0 text-muted">Maryland (21201)</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="Lary Doe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadioInline1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" value="1994-12-16">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Martail Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Select Marital Status</option>
                                            <option>Married</option>
                                            <option selected>Unmarried</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control">4289 Calvin Street,  Baltimore, near MD Tower Maryland, Maryland (21201)</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Contact Information</h5>
                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-dont-edit" aria-expanded="false" aria-controls="pro-dont-edit-1 pro-dont-edit-2">
                                <i class="feather icon-edit"></i>
                            </button>
                        </div>
                        <div class="card-body border-top pro-dont-edit collapse show" id="pro-dont-edit-1">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
                                    <div class="col-sm-9">
                                        +1 9999-999-999
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
                                    <div class="col-sm-9">
                                        Demo@domain.com
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
                                    <div class="col-sm-9">
                                        @phonixcoded
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
                                    <div class="col-sm-9">
                                        @phonixcoded demo
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body border-top pro-dont-edit collapse " id="pro-dont-edit-2">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="+1 9999-999-999">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded demo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">other Information</h5>
                            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-wrk-edit" aria-expanded="false" aria-controls="pro-wrk-edit-1 pro-wrk-edit-2">
                                <i class="feather icon-edit"></i>
                            </button>
                        </div>
                        <div class="card-body border-top pro-wrk-edit collapse show" id="pro-wrk-edit-1">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
                                    <div class="col-sm-9">
                                        Designer
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Skills</label>
                                    <div class="col-sm-9">
                                        C#, Javascript, Scss
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
                                    <div class="col-sm-9">
                                        Codedthemes
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body border-top pro-wrk-edit collapse " id="pro-wrk-edit-2">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full Name" value="Designer">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                                            <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-1" checked>
                                            <label class="custom-control-label" for="pro-wrk-chk-1">C#</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                                            <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-2" checked>
                                            <label class="custom-control-label" for="pro-wrk-chk-2">Javascript</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                                            <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-3" checked>
                                            <label class="custom-control-label" for="pro-wrk-chk-3">Scss</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                                            <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-4">
                                            <label class="custom-control-label" for="pro-wrk-chk-4">Html</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card user-card user-card-1">
                                <div class="card-header border-0 p-2 pb-0">
                                    <div class="cover-img-block">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="assets/images/widget/slider5.jpg" alt="" class="img-fluid">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/widget/slider6.jpg" alt="" class="img-fluid">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/widget/slider7.jpg" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-end">
                                            <div class="col text-left pb-3"><a href="#!"><i class="icon feather icon-star text-muted f-20"></i></a></div>
                                            <div class="col"><img class="img-radius img-fluid wid-80" src="assets/images/user/avatar-4.jpg" alt="User image"></div>
                                            <div class="col text-right pb-3">
                                                <div class="dropdown">
                                                    <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-1 mt-3">Joseph William</h6>
                                        <p class="mb-3 text-muted">UI/UX Designer</p>
                                        <p class="mb-1">Lorem Ipsum is simply dummy text</p>
                                        <p class="mb-0">been the industry's standard</p>
                                    </div>
                                    <hr class="wid-80 b-wid-3 my-4">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h6 class="mb-1">37</h6>
                                            <p class="mb-0">Mails</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">2749</h6>
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">678</h6>
                                            <p class="mb-0">Following</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-card user-card-1">
                                <div class="card-header border-0 p-2 pb-0">
                                    <div class="cover-img-block">
                                        <img src="assets/images/widget/slider6.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-end">
                                            <div class="col text-left pb-3"><a href="#!"><i class="icon feather icon-star-on text-c-yellow f-20"></i></a></div>
                                            <div class="col">
                                                <div class="position-relative d-inline-block">
                                                    <img class="img-radius img-fluid wid-80" src="assets/images/user/avatar-5.jpg" alt="User image">
                                                    <div class="certificated-badge">
                                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                                        <i class="fas fa-check front-icon text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-right pb-3">
                                                <div class="dropdown">
                                                    <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-1 mt-3">Suzen</h6>
                                        <p class="mb-3 text-muted">UI/UX Designer</p>
                                        <p class="mb-1">Lorem Ipsum is simply dummy text</p>
                                        <p class="mb-0">been the industry's standard</p>
                                    </div>
                                    <hr class="wid-80 b-wid-3 my-4">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h6 class="mb-1">37</h6>
                                            <p class="mb-0">Mails</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">2749</h6>
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">678</h6>
                                            <p class="mb-0">Following</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-card user-card-1">
                                <div class="card-header border-0 p-2 pb-0">
                                    <div class="cover-img-block">
                                        <img src="assets/images/widget/slider7.jpg" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-end">
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="position-relative d-inline-block">
                                                    <img class="img-radius img-fluid wid-80" src="assets/images/user/avatar-1.jpg" alt="User image">
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-1 mt-3">John Doe</h6>
                                        <p class="mb-3 text-muted">UI/UX Designer</p>
                                        <p class="mb-1">Lorem Ipsum is simply dummy text</p>
                                        <p class="mb-0">been the industry's standard</p>
                                    </div>
                                    <hr class="wid-80 b-wid-3 my-4">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h6 class="mb-1">37</h6>
                                            <p class="mb-0">Mails</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">2749</h6>
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">678</h6>
                                            <p class="mb-0">Following</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body hover-data text-white">
                                    <div class="">
                                        <h4 class="text-white">Hire Me?</h4>
                                        <p class="mb-1">Lorem Ipsum is simply dummy text</p>
                                        <p class="mb-3">been the industry's standard</p>
                                        <button type="button" class="btn waves-effect waves-light btn-warning"><i class="feather icon-link"></i> Meating</button>
                                        <button type="button" class="btn waves-effect waves-light btn-danger"><i class="feather icon-download"></i> Resume</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-card user-card-2 shape-center">
                                <div class="card-header border-0 p-2 pb-0">
                                    <div class="cover-img-block">
                                        <div id="carouselExampleControls-2" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="assets/images/widget/slider7.jpg" alt="" class="img-fluid">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/widget/slider6.jpg" alt="" class="img-fluid">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/widget/slider5.jpg" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls-2" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
                                            <a class="carousel-control-next" href="#carouselExampleControls-2" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-end">
                                            <div class="col text-left pb-3"><a href="#!"><i class="icon feather icon-star-on text-c-yellow f-20"></i></a></div>
                                            <div class="col">
                                                <div class="position-relative d-inline-block">
                                                    <img class="img-radius img-fluid wid-80" src="assets/images/user/avatar-5.jpg" alt="User image">
                                                    <div class="certificated-badge">
                                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                                        <i class="fas fa-check front-icon text-white"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-right pb-3">
                                                <div class="dropdown">
                                                    <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-1 mt-3">Suzen</h6>
                                        <p class="mb-3 text-muted">UI/UX Designer</p>
                                        <p class="mb-1">Lorem Ipsum is simply dummy text</p>
                                        <p class="mb-0">been the industry's standard</p>
                                    </div>
                                    <hr class="wid-80 b-wid-3 my-4">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h6 class="mb-1">37</h6>
                                            <p class="mb-0">Mails</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">2749</h6>
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">678</h6>
                                            <p class="mb-0">Following</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="row text-center">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l1.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl1.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l2.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl2.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l3.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl3.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l4.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl4.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l5.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl5.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="assets/images/light-box/l6.jpg" data-lightbox="roadtrip"><img src="assets/images/light-box/sl6.jpg" class="img-fluid m-b-10 img-thumbnail bg-white" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Friends</h5>
                    <span class="badge badge-light-primary float-right">100+</span>
                </div>
                <div class="card-body">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius mb-2 wid-50" data-toggle="tooltip" title="Joseph William"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius mb-2 wid-50" data-toggle="tooltip" title="Sara Soudein"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius mb-2 wid-50" data-toggle="tooltip" title="John Doe"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-4.jpg" alt="user image" class="img-radius mb-2 wid-50" data-toggle="tooltip" title="Joseph William"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-5.jpg" alt="user image" class="img-radius wid-50" data-toggle="tooltip" title="Sara Soudein"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-50" data-toggle="tooltip" title="Joseph William"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-50" data-toggle="tooltip" title="Sara Soudein"></a></li>
                        <li class="list-inline-item"><a href="#!"><img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-50" data-toggle="tooltip" title="John Doe"></a></li>
                    </ul>
                </div>
            </div>
            <div class="card new-cust-card">
                <div class="card-header">
                    <h5>Message</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="cust-scroll" style="height:415px;position:relative;">
                    <div class="card-body p-b-0">
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>Alex Thompson</h6>
                                </a>
                                <p class="m-b-0">Cheers!</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>John Doue</h6>
                                </a>
                                <p class="m-b-0">stay hungry!</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>Alex Thompson</h6>
                                </a>
                                <p class="m-b-0">Cheers!</p>
                                <span class="status deactive">30 min ago</span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-4.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>John Doue</h6>
                                </a>
                                <p class="m-b-0">Cheers!</p>
                                <span class="status deactive">10 min ago</span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-5.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>Shirley Hoe</h6>
                                </a>
                                <p class="m-b-0">stay hungry!</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-1.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>John Doue</h6>
                                </a>
                                <p class="m-b-0">Cheers!</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle m-b-25">
                            <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>Jon Alex</h6>
                                </a>
                                <p class="m-b-0">stay hungry!</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle m-b-0">
                            <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius align-top m-r-15">
                            <div class="d-inline-block">
                                <a href="#!">
                                    <h6>John Doue</h6>
                                </a>
                                <p class="m-b-0">Cheers!</p>
                                <span class="status deactive">10 min ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- profile body end -->

    <div class="row">

        <div class="col-12 col-md-4 border border-bottom-0 border-right-0">
            {{--<div class="border-left-primary h-100 p-3 ">
                @if(auth()->user()->profile)
                    <img src="{{Storage::disk('local')->url('/profile/'.auth()->user()->id.'/'.auth()->user()->profile)}}" class="img-fluid">
                @else
                    <img src="{{url('img/profile.png')}}" class="img-fluid">
                @endif
                <h4 class="mt-4 text-success text-center border-bottom border-success">{{auth()->user()->fname}} {{auth()->user()->lname}}</h4>
                    <p><i class="fa fa-map-marker user-profile-icon"></i>  {{auth()->user()->address}}</p>
                    <p><i class="fa fa-phone"></i> {{auth()->user()->phone}}</p>
                    <p>
                        <i class="fa fa-envelope"></i> {{auth()->user()->email}}
                    </p>
                    <p><i class="fa fa-briefcase user-profile-icon"></i> {{auth()->user()->designations->name}} - {{auth()->user()->departments->name}}</p>
                    <p class="text-center"><small class="text-center"> Member since {{date('Y',strtotime(auth()->user()->created_at))}} <i class="fa fa-clock-o"></i></small></p>

            </div>--}}
        </div>
        <div class="row">
        {{--    <div class="text-right col-12 my-2">
                <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#changeprofile"><i class="fa fa-upload"></i> Upload Profile</button>
            </div>
        </div>
        <div class="col-md-8 col-12 x_panel p-3">
                <div class="x_title">
                    <h3 class="pull-left"><i class="fa fa-sort"></i> My Profile </h3>
                    @if(auth()->user()->cv)
                        <a href="{{Storage::disk('local')->url('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)}}" target="_blank" class="btn btn-app btn-lg pull-right">
                            <i class="fa fa-cloud-download"></i>
                            Curriculum Vitae ( {{number_format((Storage::disk('local')->size('public/cv/'.auth()->user()->id.'/'.auth()->user()->cv)/1024),2)}} KBs )

                        </a>
                    @endif
                    <div class="clearfix"></div>

                </div>
                <div class="x_content">
                    <h3 class="text-danger bg-light p-2"><i class="fa fa-caret-right"></i> {{auth()->user()->roles->name}}</h3>
                    <h6><i class="fa fa-toggle-right text-danger"></i> Father Name <i class="fa fa-caret-right ml-2"></i>  {{auth()->user()->father_name}}</h6>
                    <h6><i class="fa fa-info text-danger"></i> CNIC <i class="fa fa-caret-right ml-2"></i>  {{auth()->user()->cnic}}</h6>
                    <h6><i class="fa fa-calendar text-danger"></i> Date of Birth <i class="fa fa-caret-right ml-2"></i>  {{date('d M Y',strtotime(auth()->user()->dob))}}</h6>
                    <h6><i class="fa fa-calendar text-danger"></i> Date of Joining <i class="fa fa-caret-right ml-2"></i>  {{date('d M Y',strtotime(auth()->user()->joining))}}</h6>

                    @if(auth()->user()->signature)
                        <div class="text-right">
                            <img src="{{Storage::disk('local')->url('public/signature/'.auth()->user()->id.'/'.auth()->user()->signature)}}" width="200" class="img-fluid">
                        </div>
                    @endif
                </div>

        </div>
        --}}
    </div>
{{--
    <div class="row">
        <div class="col-12">
            <h3 class="pull-left border-bottom pb-1"><i class="fa fa-clock-o"></i> Attendance</h3>
            <table class="table table-hover table-sm bg-white">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attendances as $attendence)
                    <tr>
                        <td>{{$attendence->check_in_date}}</td>
                        <td>{{$attendence->day}}</td>
                        <td>{{$attendence->check_in_date}} {{date('h:i A',strtotime($attendence->check_in))}}</td>
                        <td>{{$attendence->check_out_date}} {{date('h:i A',strtotime($attendence->check_out))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade" id="changeprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{url('/set_profile')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
--}}

@endsection