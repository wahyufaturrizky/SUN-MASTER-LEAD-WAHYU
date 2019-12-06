@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

@section('content')
    <!-- Page Content -->
    <div class="content">

    	<!-- Block Tabs Default Style -->
                           
<h1 class="text-center">Family Card</h1>
  <hr>

    <form action="{{ route('addFamily') }}" method="post">   
      @csrf  
      <div class="col-md-12">
          <div class="row">

            <div class="form-group col-md-6">
              <label for="familyCard_id">Family Card ID (No.KK)</label>
              <input type="text" class="form-control" name="familyCard_id" id="familyCard_id" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="fatherName">Father Name</label>
              <input type="text" class="form-control" name="fatherName" id="fatherName" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="familyName">Family Name</label>
              <input type="text" class="form-control" name="familyName" id="familyName" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="dobf">Date of Birth</label>
              <input type="date" class="form-control" name="dobf" id="dobf" placeholder="" required>
            </div>

            <hr>

            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="motherName">Mother Name</label>
              <input type="text" class="form-control" name="motherName" id="motherName" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="familyMobilePhone">Family Mobile Phone</label>
              <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" class="form-control" name="familyMobilePhone" id="familyMobilePhone" placeholder="" required>
              </div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="dobm">Date of Birth</label>
              <input type="date" class="form-control" name="dobm" id="dobm" placeholder="" required>
            </div>

             <div class="form-group col-md-6">
              <label for="homeAddressPhone">Home Address Phone</label>
              <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" class="form-control" name="homeAddressPhone" id="homeAddressPhone" placeholder="" required>
              </div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="postCode">Post Code / City Area</label>
              <input type="text" class="form-control" name="postCode" id="postCode" placeholder="" required>
            </div>

            <div class="form-group col-md-6">
              <label for="address">Full Address:</label>
              <textarea name="address" id="address" class="form-control" rows="6" style="resize:none;" required></textarea>
            </div>
            
          </div>
        </div>
        
        
        <hr>
        <h1 class="text-center">Siblings</h1>
        {{-- <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Tambah</button> --}}
        
        <div class="col-md-12">
          <div class="row">
            
            <div class="form-group col-md-3">
              <label for="siblingName">Sibling Name</label>
              <input type="text" class="form-control" id="siblingName" name="siblingName" value="">
            </div>

            {{-- <div class="form-group col-md-3">
              <label for="siblingName">ID Families</label>
              <input type="text" class="form-control" id="id_families" name="id_families" value="">
            </div> --}}
            
            {{-- <div class="form-group col-md-3">
              <label for="dob">Date Of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" value="">  
            </div>
            
            <div class="form-group col-md-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="">
            </div>
            
            <div class="form-group col-md-3">
              <label for="mobilePhone">Mobile Phone</label>
              <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" value="">
            </div> --}}
            
            <div class="form-group col-md-6">
              <br><br><br><br><br>
              <button class="btn btn-alt-primary" type="submit" > <span class="glyphicon glyphicon-plus" aria-hidden="true" ></span>Submit</button>
            </div>
            
          </div>
        </div>
        
      </form>
      <br><br>
      {{-- 
        <div id="education_fields"></div>
  <div class="clear"></div> --}}
                                   

  
   

  
  
	</div>	  


@endsection

    