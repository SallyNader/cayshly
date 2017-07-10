@extends('partials.general-master')

@section('title') Contact Cayshly @endsection

@section('content')
	<div class="w-res">
		<div class="g-p">
			<div class="g-p-t">
				<h1 class="g-p-t-txt">Contact Cayshly</h1>
				<p>Tell us about what you need and we will help</p>
			</div>
			<div class="g-p-m">
				<!-- The Form here -->
				<div class="p-p-manage-c">
					{!! Form::open(['url'=>'#']) !!}
					<fieldset class="f-s">
						<legend>Please Fill this out</legend>
						<div class="user-info-c">
							<p>
								<label>Name : </label>
								<input type="text" autofocus name="ahmed"/>
							</p>
							<p>
								<label>Email : </label>
								<input type="text" name="ahmed"/>
							</p>
							<p>
								<label>Subject about : </label>
								<input type="text" name="ahmed"/>
							</p>
							<p>
								<label>Descripe What you need : </label>
								<textarea name="ahmed"></textarea>
							</p>
						</div>
						<input type="submit" class="btn btn-red fl-right" value="Send">
						<div class="clear"></div>
					</fieldset>
					
                    <div class="clear"></div>
                    {!! Form::close() !!}	
				</div>
			</div>
		</div>
	</div>
@endsection