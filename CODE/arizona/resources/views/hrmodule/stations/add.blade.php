@include('template.admin_header')

@php



@endphp
<div class="main-section">
	<div class="container">
        <div class="row">
			<div class="inner-main-section">
				<div class="col-md-12 col-sm-12">
					<div class="left-bar-request nopadding">
						<div class="sidebar-menu">
                        @include('template.organisation_nav_icon')
						</div>
					</div>
					<div class="right-bar-request">
						<div class="request-section">
							<div class="main-heading">
								<div class="inner-heading-request">
									<h2>{{$pageTitle}}</h2>
								</div>
								<!-- <div class="settings-buttons">
									<ul>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-cog"></i></a>
										</li>
										<li>
											<a href="#" alt="Dashboard"><i class="fa fa-question-circle"></i></a>
										</li>
									</ul>
								</div> -->
							</div>
							<div class="request-inner-table">
								<div class="upper-header-request">
									<div class="col-md-12 nopadding">
										<div class="back-button">
											<div class="add-record-btn">
												<a href="{{ url('stations') }}"><i class="fa fa-angle-left"></i>Back</a>
											</div>
										</div>
									</div>
								</div>
								<div class="inner-form-main">
									<div class="form-heading-space">
										<h3>{{$Addform}}</h3>
									</div>
									<div class="form-upper-main">
										<h4>Station Information</h4>
									</div>
									<div class="form-subsets">

                                    @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="post" action="{{ url('stations/save') }}">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="id" value="{{isset($result->id)?$result->id:''}}">

											<div class="form-field-inner">

												 <div class="form-group">
													<label>Company:</label>

													<select id="company_id" class="WebHRForm1 chosen-select" style="width:180px;" name="company_id">
													<!-- <option value="ALL"> All </option> -->
													@foreach($master['Companies'] as $val)
													<!-- <option  value="{{$val['company_name']}}">{{$val['company_name']}}</option> -->
													<option  value="{{$val['id']}}" @php if(isset($result->company_id) && $result->company_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['company_name']}}</option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="To add multiple companies, please go to Organization - Companies module" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
													<!-- <select id ="division_id" name ="division_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Divisions'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->division_id) && $result->division_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['division_name']}}</option>
													@endforeach
													</select> -->

												 </div>

                                                 <div class="form-group">
													<label>Division:</label>
													<!-- <select id="st" name="division" class="WebHRForm1" style="width:180px;"><option style="" value="Head Office">Division one</option></select> -->
													<select id ="division_id" name ="division_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Divisions'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->division_id) && $result->division_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['division_name']}}</option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="To add multiple divisions, please go to Organization - Division module" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>

												 </div>

                                                 <div class="form-group">
													<label>Station Type:</label>
													<select id ="station_type_id" name ="station_type_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['StationTypes'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_type_id) && $result->station_type_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['station_type_name']}}</option>
													@endforeach
													</select>
													<a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="To add more Station Types, please go to Organization -> System Settings -> Constants" data-original-title="" title=""><i style="font-size:14px; color:yellow;" class="fa fa-info-circle"></i></a>
												 </div>

												 <div class="form-group">
													<label>Station Name:</label>
													<input type="text" id="station_name" name="station_name" value="{{isset($result->station_name)?$result->station_name:''}}" placeholder="Station Name" class="form-control-spacial" />
													<i title="Mandatory Field" style="font-size:10px; color:#ff0000;" class="fa fa-asterisk"></i>

												 </div>

												 <div class="form-group">
													<label>Time Zone:</label>
													 <select id="tz" name="time_zone" class="WebHRForm1 chosen-select" style="width:180px;"><option style="" value="Kwajalein">(GMT-12:00) International Date Line West</option><option style="" value="Pacific/Midway">(GMT-11:00) Midway Island</option><option style="" value="Pacific/Samoa">(GMT-11:00) Samoa</option><option style="" value="Pacific/Honolulu">(GMT-10:00) Hawaii</option><option style="" value="America/Anchorage">(GMT-09:00) Alaska</option><option style="" value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &amp; Canada)</option><option style="" value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option><option style="" value="America/Denver">(GMT-07:00) Mountain Time (US &amp; Canada)</option><option style="" value="America/Chihuahua">(GMT-07:00) Chihuahua</option><option style="" value="America/Mazatlan">(GMT-07:00) Mazatlan</option><option style="" value="America/Phoenix">(GMT-07:00) Arizona</option><option style="" value="America/Regina">(GMT-06:00) Saskatchewan</option><option style="" value="America/Tegucigalpa">(GMT-06:00) Central America</option><option style="" value="America/Chicago">(GMT-06:00) Central Time (US &amp; Canada)</option><option style="" value="America/Mexico_City">(GMT-06:00) Mexico City</option><option style="" value="America/Monterrey">(GMT-06:00) Monterrey</option><option style="" value="America/New_York">(GMT-05:00) Eastern Time (US &amp; Canada)</option><option style="" value="America/Bogota">(GMT-05:00) Bogota</option><option style="" value="America/Lima">(GMT-05:00) Lima</option><option style="" value="America/Rio_Branco">(GMT-05:00) Rio Branco</option><option style="" value="America/Indiana/Indianapolis">(GMT-05:00) Indiana (East)</option><option style="" value="America/Caracas">(GMT-04:30) Caracas</option><option style="" value="America/Halifax">(GMT-04:00) Atlantic Time (Canada)</option><option style="" value="America/Manaus">(GMT-04:00) Manaus</option><option style="" value="America/Santiago">(GMT-04:00) Santiago</option><option style="" value="America/La_Paz">(GMT-04:00) La Paz</option><option style="" value="America/St_Johns">(GMT-03:30) Newfoundland</option><option style="" value="America/Argentina/Buenos_Aires">(GMT-03:00) Georgetown</option><option style="" value="America/Sao_Paulo">(GMT-03:00) Brasilia</option><option style="" value="America/Godthab">(GMT-03:00) Greenland</option><option style="" value="America/Montevideo">(GMT-03:00) Montevideo</option><option style="" value="Atlantic/South_Georgia">(GMT-02:00) Mid-Atlantic</option><option style="" value="Atlantic/Azores">(GMT-01:00) Azores</option><option style="" value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option><option style="" value="Europe/Dublin">(GMT) Dublin</option><option style="" value="Europe/Lisbon">(GMT) Lisbon</option><option style="" value="Europe/London">(GMT) London</option><option style="" value="Africa/Monrovia">(GMT) Monrovia</option><option style="" value="Atlantic/Reykjavik">(GMT) Reykjavik</option><option style="" value="Africa/Casablanca">(GMT) Casablanca</option><option style="" value="Europe/Belgrade">(GMT+01:00) Belgrade</option><option style="" value="Europe/Bratislava">(GMT+01:00) Bratislava</option><option style="" value="Europe/Budapest">(GMT+01:00) Budapest</option><option style="" value="Europe/Ljubljana">(GMT+01:00) Ljubljana</option><option style="" value="Europe/Prague">(GMT+01:00) Prague</option><option style="" value="Europe/Sarajevo">(GMT+01:00) Sarajevo</option><option style="" value="Europe/Skopje">(GMT+01:00) Skopje</option><option style="" value="Europe/Warsaw">(GMT+01:00) Warsaw</option><option style="" value="Europe/Zagreb">(GMT+01:00) Zagreb</option><option style="" value="Europe/Brussels">(GMT+01:00) Brussels</option><option style="" value="Europe/Copenhagen">(GMT+01:00) Copenhagen</option><option style="" value="Europe/Madrid">(GMT+01:00) Madrid</option><option style="" value="Europe/Paris">(GMT+01:00) Paris</option><option style="" value="Africa/Algiers">(GMT+01:00) West Central Africa</option><option style="" value="Europe/Amsterdam">(GMT+01:00) Amsterdam</option><option style="" value="Europe/Berlin">(GMT+01:00) Berlin</option><option style="" value="Europe/Rome">(GMT+01:00) Rome</option><option style="" value="Europe/Stockholm">(GMT+01:00) Stockholm</option><option style="" value="Europe/Vienna">(GMT+01:00) Vienna</option><option style="" value="Europe/Minsk">(GMT+02:00) Minsk</option><option style="" value="Africa/Cairo">(GMT+02:00) Cairo</option><option style="" value="Europe/Helsinki">(GMT+02:00) Helsinki</option><option style="" value="Europe/Riga">(GMT+02:00) Riga</option><option style="" value="Europe/Sofia">(GMT+02:00) Sofia</option><option style="" value="Europe/Tallinn">(GMT+02:00) Tallinn</option><option style="" value="Europe/Vilnius">(GMT+02:00) Vilnius</option><option style="" value="Europe/Athens">(GMT+02:00) Athens</option><option style="" value="Europe/Bucharest">(GMT+02:00) Bucharest</option><option style="" value="Europe/Istanbul">(GMT+02:00) Istanbul</option><option style="" value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option><option style="" value="Asia/Amman">(GMT+02:00) Amman</option><option style="" value="Asia/Beirut">(GMT+02:00) Beirut</option><option style="" value="Africa/Windhoek">(GMT+02:00) Windhoek</option><option style="" value="Africa/Harare">(GMT+02:00) Harare</option><option style="" value="Asia/Kuwait">(GMT+03:00) Kuwait</option><option style="" value="Asia/Riyadh">(GMT+03:00) Riyadh</option><option style="" value="Asia/Baghdad">(GMT+03:00) Baghdad</option><option style="" value="Africa/Nairobi">(GMT+03:00) Nairobi</option><option style="" value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option><option style="" value="Europe/Moscow">(GMT+03:00) Moscow</option><option style="" value="Europe/Volgograd">(GMT+03:00) Volgograd</option><option style="" value="Asia/Tehran">(GMT+03:30) Tehran</option><option style="" value="Asia/Dubai">(GMT+04:00) Dubai</option><option style="" value="Asia/Muscat">(GMT+04:00) Muscat</option><option style="" value="Asia/Baku">(GMT+04:00) Baku</option><option style="" value="Asia/Yerevan">(GMT+04:00) Yerevan</option><option style="" value="Asia/Kabul">(GMT+04:30) Kabul</option><option style="" value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option><option style="" value="Asia/Karachi">(GMT+05:00) Karachi</option><option style="" value="Asia/Tashkent">(GMT+05:00) Tashkent</option><option style="" value="Asia/Kolkata">(GMT+05:30) Calcutta</option><option style="" value="Asia/Colombo">(GMT+05:30) Sri Jayawardenepura</option><option style="" value="Asia/Katmandu">(GMT+05:45) Kathmandu</option><option style="" value="Asia/Dhaka">(GMT+06:00) Dhaka</option><option style="" value="Asia/Almaty">(GMT+06:00) Almaty</option><option style="" value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option><option style="" value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option><option style="" value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option><option style="" value="Asia/Bangkok">(GMT+07:00) Bangkok</option><option style="" value="Asia/Jakarta">(GMT+07:00) Jakarta</option><option style="" value="Asia/Brunei">(GMT+08:00) Beijing</option><option style="" value="Asia/Chongqing">(GMT+08:00) Chongqing</option><option style="" value="Asia/Hong_Kong">(GMT+08:00) Hong Kong</option><option style="" value="Asia/Urumqi">(GMT+08:00) Urumqi</option><option style="" value="Asia/Irkutsk">(GMT+08:00) Irkutsk</option><option style="" value="Asia/Ulaanbaatar">(GMT+08:00) Ulaan Bataar</option><option style="" value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur</option><option style="" value="Asia/Singapore">(GMT+08:00) Singapore</option><option style="" value="Asia/Taipei">(GMT+08:00) Taipei</option><option style="" value="Australia/Perth">(GMT+08:00) Perth</option><option style="" value="Asia/Seoul">(GMT+09:00) Seoul</option><option style="" value="Asia/Tokyo">(GMT+09:00) Tokyo</option><option style="" value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option><option style="" value="Australia/Darwin">(GMT+09:30) Darwin</option><option style="" value="Australia/Adelaide">(GMT+09:30) Adelaide</option><option style="" value="Australia/Canberra">(GMT+10:00) Canberra</option><option style="" value="Australia/Melbourne">(GMT+10:00) Melbourne</option><option style="" value="Australia/Sydney">(GMT+10:00) Sydney</option><option style="" value="Australia/Brisbane">(GMT+10:00) Brisbane</option><option style="" value="Australia/Hobart">(GMT+10:00) Hobart</option><option style="" value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option><option style="" value="Pacific/Guam">(GMT+10:00) Guam</option><option style="" value="Pacific/Port_Moresby">(GMT+10:00) Port Moresby</option><option style="" value="Asia/Magadan">(GMT+11:00) Magadan</option><option style="" value="Pacific/Fiji">(GMT+12:00) Fiji</option><option style="" value="Asia/Kamchatka">(GMT+12:00) Kamchatka</option><option style="" value="Pacific/Auckland">(GMT+12:00) Auckland</option><option style="" value="Pacific/Tongatapu">(GMT+13:00) Nukualofa</option></select>
												 </div>

												 <div class="form-group">
													<label>Currency:</label>

													<select id="cur" class="WebHRForm1 chosen-select" name="currency" style="width:180px;"><option style="" value="USD">United States - Dollar (USD)</option><option style="" value="EUR">Euro (EUR)</option><option style="" value="AED">United Arab Emirates dirham</option><option style="" value="AFN">Afghan afghani</option><option style="" value="ALL">Albanian lek</option><option style="" value="AMD">Armenian dram</option><option style="" value="ANG">Netherlands Antillean guilder</option><option style="" value="AOA">Angolan kwanza</option><option style="" value="ARS">Argentine peso</option><option style="" value="AUD">Australian dollar</option><option style="" value="AWG">Aruban florin</option><option style="" value="AZN">Azerbaijani manat</option><option style="" value="BAM">Bosnia and Herzegovina convertible mark</option><option style="" value="BBD">Barbados dollar</option><option style="" value="BDT">Bangladeshi taka</option><option style="" value="BGN">Bulgarian lev</option><option style="" value="BHD">Bahraini dinar</option><option style="" value="BIF">Burundian franc</option><option style="" value="BMD">Bermudian dollar</option><option style="" value="BND">Brunei dollar</option><option style="" value="BOB">Boliviano</option><option style="" value="BOV">Bolivian Mvdol</option><option style="" value="BRL">Brazilian real</option><option style="" value="BSD">Bahamian dollar</option><option style="" value="BTN">Bhutanese ngultrum</option><option style="" value="BWP">Botswana pula</option><option style="" value="BYR">Belarusian ruble</option><option style="" value="BZD">Belize dollar</option><option style="" value="CAD">Canadian dollar</option><option style="" value="CDF">Congolese franc</option><option style="" value="CHE">WIR Euro</option><option style="" value="CHF">Swiss franc</option><option style="" value="CHW">WIR Franc</option><option style="" value="CLF">Unidad de Fomento</option><option style="" value="CLP">Chilean peso</option><option style="" value="CNY">Chinese yuan</option><option style="" value="COP">Colombian peso</option><option style="" value="COU">Unidad de Valor Real</option><option style="" value="CRC">Costa Rican colon</option><option style="" value="CUC">Cuban convertible peso</option><option style="" value="CUP">Cuban peso</option><option style="" value="CVE">Cape Verde escudo</option><option style="" value="CZK">Czech koruna</option><option style="" value="DJF">Djiboutian franc</option><option style="" value="DKK">Danish krone</option><option style="" value="DOP">Dominican peso</option><option style="" value="DZD">Algerian dinar</option><option style="" value="EGP">Egyptian pound</option><option style="" value="ERN">Eritrean nakfa</option><option style="" value="ETB">Ethiopian birr</option><option style="" value="FJD">Fiji dollar</option><option style="" value="FKP">Falkland Islands pound</option><option style="" value="GBP">Pound sterling</option><option style="" value="GEL">Georgian lari</option><option style="" value="GHS">Ghanaian cedi</option><option style="" value="GIP">Gibraltar pound</option><option style="" value="GMD">Gambian dalasi</option><option style="" value="GNF">Guinean franc</option><option style="" value="GTQ">Guatemalan quetzal</option><option style="" value="GYD">Guyanese dollar</option><option style="" value="HKD">Hong Kong dollar</option><option style="" value="HNL">Honduran lempira</option><option style="" value="HRK">Croatian kuna</option><option style="" value="HTG">Haitian gourde</option><option style="" value="HUF">Hungarian forint</option><option style="" value="IDR">Indonesian rupiah</option><option style="" value="ILS">Israeli new sheqel</option><option style="" value="INR">Indian rupee</option><option style="" value="IQD">Iraqi dinar</option><option style="" value="IRR">Iranian rial</option><option style="" value="ISK">Icelandic krona</option><option style="" value="JMD">Jamaican dollar</option><option style="" value="JOD">Jordanian dinar</option><option style="" value="JPY">Japanese yen</option><option style="" value="KES">Kenyan shilling</option><option style="" value="KGS">Kyrgyzstani som</option><option style="" value="KHR">Cambodian riel</option><option style="" value="KMF">Comoro franc</option><option style="" value="KPW">North Korean won</option><option style="" value="KRW">South Korean won</option><option style="" value="KWD">Kuwaiti dinar</option><option style="" value="KYD">Cayman Islands dollar</option><option style="" value="KZT">Kazakhstani tenge</option><option style="" value="LAK">Lao kip</option><option style="" value="LBP">Lebanese pound</option><option style="" value="LKR">Sri Lankan rupee</option><option style="" value="LRD">Liberian dollar</option><option style="" value="LSL">Lesotho loti</option><option style="" value="LTL">Lithuanian litas</option><option style="" value="LVL">Latvian lats</option><option style="" value="LYD">Libyan dinar</option><option style="" value="MAD">Moroccan dirham</option><option style="" value="MDL">Moldovan leu</option><option style="" value="MGA">Malagasy ariary</option><option style="" value="MKD">Macedonian denar</option><option style="" value="MMK">Myanma kyat</option><option style="" value="MNT">Mongolian tugrik</option><option style="" value="MOP">Macanese pataca</option><option style="" value="MRO">Mauritanian ouguiya</option><option style="" value="MUR">Mauritian rupee</option><option style="" value="MVR">Maldivian rufiyaa</option><option style="" value="MWK">Malawian kwacha</option><option style="" value="MXN">Mexican peso</option><option style="" value="MXV">Mexican Unidad de Inversion (UDI)</option><option style="" value="MYR">Malaysian ringgit</option><option style="" value="MZN">Mozambican metical</option><option style="" value="NAD">Namibian dollar</option><option style="" value="NGN">Nigerian naira</option><option style="" value="NIO">Nicaraguan cordoba</option><option style="" value="NOK">Norwegian krone</option><option style="" value="NPR">Nepalese rupee</option><option style="" value="NZD">New Zealand dollar</option><option style="" value="OMR">Omani rial</option><option style="" value="PAB">Panamanian balboa</option><option style="" value="PEN">Peruvian nuevo sol</option><option style="" value="PGK">Papua New Guinean kina</option><option style="" value="PHP">Philippine peso</option><option style="" value="PKR">Pakistani rupee</option><option style="" value="PLN">Polish zloty</option><option style="" value="PYG">Paraguayan guarani</option><option style="" value="QAR">Qatari rial</option><option style="" value="RON">Romanian new leu</option><option style="" value="RSD">Serbian dinar</option><option style="" value="RUB">Russian rouble</option><option style="" value="RWF">Rwandan franc</option><option style="" value="SAR">Saudi riyal</option><option style="" value="SBD">Solomon Islands dollar</option><option style="" value="SCR">Seychelles rupee</option><option style="" value="SDG">Sudanese pound</option><option style="" value="SEK">Swedish krona/kronor</option><option style="" value="SGD">Singapore dollar</option><option style="" value="SHP">Saint Helena pound</option><option style="" value="SLL">Sierra Leonean leone</option><option style="" value="SOS">Somali shilling</option><option style="" value="SRD">Surinamese dollar</option><option style="" value="SSP">South Sudanese pound</option><option style="" value="STD">Sao Tome and Principe dobra</option><option style="" value="SYP">Syrian pound</option><option style="" value="SZL">Swazi lilangeni</option><option style="" value="THB">Thai baht</option><option style="" value="TJS">Tajikistani somoni</option><option style="" value="TMT">Turkmenistani manat</option><option style="" value="TND">Tunisian dinar</option><option style="" value="TOP">Tongan pa?anga</option><option style="" value="TRY">Turkish lira</option><option style="" value="TTD">Trinidad and Tobago dollar</option><option style="" value="TWD">New Taiwan dollar</option><option style="" value="TZS">Tanzanian shilling</option><option style="" value="UAH">Ukrainian hryvnia</option><option style="" value="UGX">Ugandan shilling</option><option style="" value="UYI">Uruguay Peso en Unidades Indexadas</option><option style="" value="UYU">Uruguayan peso</option><option style="" value="UZS">Uzbekistan som</option><option style="" value="VEF">Venezuelan bolivar fuerte</option><option style="" value="VND">Vietnamese d?ng</option><option style="" value="VUV">Vanuatu vatu</option><option style="" value="WST">Samoan tala</option><option style="" value="XAF">CFA franc BEAC</option><option style="" value="XCD">East Caribbean dollar</option><option style="" value="XDR">Special drawing rights</option><option style="" value="XFU">UIC franc</option><option style="" value="XOF">CFA Franc BCEAO</option><option style="" value="XPD">Palladium</option><option style="" value="XPF">CFP franc</option><option style="" value="XPT">Platinum</option><option style="" value="XTS">Code reserved for testing purposes</option><option style="" value="XXX">No currency</option><option style="" value="YER">Yemeni rial</option><option style="" value="ZAR">South African rand</option><option style="" value="ZMK">Zambian kwacha</option><option style="" value="ZWL">Zimbabwe dollar</option></select>


												 </div>

												 <div class="form-group">
													<label>Currency Sign:</label>

													<input type="text"   id="currency_sign" name="currency_sign" value="{{isset($result->currency_sign)?$result->currency_sign:''}}" placeholder="Currency Sign" class="form-control-spacial">

												 </div>



												 <div class="form-group">
													<h4> Address</h4>
												 </div>


												 <div class="form-group">
												    <label>Address:</label>
													<input type="text"  id="address" name="address" value="{{isset($result->address)?$result->address:''}} " placeholder="Address"  class="form-control-spacial"/>

												 </div>

												 <div class="form-group">
												   <label>City:</label>
												   <input type="text" id="city"   name="city" value="{{isset($result->city)?$result->city:''}}" placeholder="City"  class="form-control-spacial" />

												 </div>

												 <div class="form-group">
												   <label>State / Province:</label>
												   <input type="text"  id="state" name="state_province" value="{{isset($result->state_province)?$result->state_province:''}}"  placeholder="State / Province"   class="form-control-spacial" />

												 </div>

												 <div class="form-group">
												   <label>Zip Code / Postal Code:</label>
												   <input type="text"  id="zip_code" name="zip_code" value="{{isset($result->zip_code)?$result->zip_code:''}}" placeholder="Zip Code / Postal Code"   class="form-control-spacial" />

												 </div>

												 <div class="form-group">
												   <label>Country:</label>
												   <!-- <input type="text" id="country" name="country" value="{{isset($result->country)?$result->country:''}}"  placeholder="Country" class="form-control-spacial" > -->
												   <select id ="country_id" name ="country_id" class="WebHRForm1 chosen-select chosen-select" style="width:180px;">
													@foreach($master['Countries'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->id) && $result->id == $val['id']  ) { echo "selected";  } @endphp >{{$val['title']}}</option>
													@endforeach
													</select>

												 </div>
												 <div class="form-group">
												   <label>Phone Number:</label>

													<input type="text" id="phone_number" name="phone_number" value="{{isset($result->phone_number)?$result->phone_number:''}}" placeholder="Phone Number" class="form-control-spacial" >

												 </div>

												 <div class="form-group">
												   <label>Fax Number:</label>

													<input type="text" placeholder="Fax Number" class="form-control-spacial" id="fax_number" name="fax_number" value="{{isset($result->fax_number)?$result->fax_number:''}}">

												 </div>

												 <div class="form-group">
												   <label>Email Address:</label>
													<input type="text" placeholder="Email Address" class="form-control-spacial" id="email_address" name="email_address" value="{{isset($result->email_address)?$result->email_address:''}}">

												 </div>

												 <div class="form-group">
												   <label>Website:</label>
													<input type="text" placeholder="Website" class="form-control-spacial" id="website" name="website" value="{{isset($result->website)?$result->website:''}}">

												 </div>


												 <div class="form-group">
													<h4>Geographical Location</h4>
												 </div>


												 <div class="form-group">
												   <label>Latitude:</label>
													<input type="text"  name="latitude" value="{{isset($result->latitude)?$result->latitude:''}}" placeholder="Latitude" class="form-control-spacial" id="government_tax_number" />

												 </div>

												 <div class="form-group">
												   <label>Longitude:</label>
												   <input type="text" id="longitude" name="longitude" value="{{isset($result->longitude)?$result->longitude:''}}" placeholder="Longitude" class="form-control-spacial" >

												 </div>

												 <div class="form-group">
												   <label>Geo Fence Radius (meters):</label>
												   <!-- <input type="text" id="geo_fence_radius" name="geo_fence_radius" value="{{isset($result->geo_fence_radius)?$result->geo_fence_radius:''}}" placeholder="Geo Fence Radius (meters):" class="form-control-spacial" > -->
												   <select id="geo_fence_radius" name="geo_fence_radius" class="WebHRForm1 chosen-select" style="width:180px;">
												   <option style="" value="50">50</option>
												   <option style="" value="100">100</option>
												   <option style="" value="200">200</option>
												   <option style="" value="500">500</option>
												   <option style="" value="1000">1000</option>
												   <option style="" value="2000">2000</option>
												   </select>
												 </div>


												 <div class="form-group">
													<h4>Station Personnel (Optional)</h4>
												 </div>
												 <div class="form-group">
												 <label>Station Head:</label>
												 <select id ="station_head_employee_id" name ="station_head_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_head_employee_id) && $result->station_head_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>
												<div class="form-group">
												<label>Station General Manager:</label>
												 <select id ="station_gm_employee_id" name ="station_gm_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_gm_employee_id) && $result->station_gm_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station Operations Manager:</label>
												 <select id ="station_om_employee_id" name ="station_om_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_om_employee_id) && $result->station_om_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station HR Manager:</label>
												 <select id ="station_hr_employee_id" name ="station_hr_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_hr_employee_id) && $result->station_hr_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station Accounts Manager:</label>
												 <select id ="station_acc_employee_id" name ="station_acc_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_acc_employee_id) && $result->station_acc_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station IT Manager:</label>
												 <select id ="station_it_employee_id" name ="station_it_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_it_employee_id) && $result->station_it_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station Payroll Manager:</label>
												 <select id ="station_payroll_employee_id" name ="station_payroll_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_payroll_employee_id) && $result->station_payroll_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Station Recruitment Manager:</label>
												 <select id ="station_recruitement_employee_id" name ="station_recruitement_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_recruitement_employee_id) && $result->station_recruitement_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Custom 1:</label>
												 <select id ="station_cus1_employee_id" name ="station_cus1_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_cus1_employee_id) && $result->station_cus1_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Custom 2:</label>
												 <select id ="station_cus2_employee_id" name ="station_cus2_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_cus2_employee_id) && $result->station_cus2_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>

												<div class="form-group">
												<label>Custom 3:</label>
												 <select id ="station_cus3_employee_id" name ="station_cus3_employee_id" class="WebHRForm1 chosen-select" style="width:180px;">
													@foreach($master['Employees'] as $val)
													<option  value="{{$val['id']}}" @php if(isset($result->station_cus3_employee_id) && $result->station_cus3_employee_id == $val['id']  ) { echo "selected";  } @endphp >{{$val['employee_name']}}</option>
													@endforeach
													</select>
												</div>


												<div class="form-group">
													<h4>Additional Information</h4>
												 </div>
												 <div class="form-group">
												 <label>Notes:</label>
													<textarea class="tinyeditorclass" name="additonal_information" id="additonal_information">{{isset($result->additonal_information)?$result->additonal_information:''}}</textarea>
												</div>


												<div class="form-group">
												 <label>Record Added By:</label>

												</div>


												<div class="form-group">
												 <label>Record Added On:</label>

												 @php
												 $date  = date("F j, Y, g:i a");

												 @endphp
												 {{$date}}
												</div>






												 <div class="form-group">
													<input class="submit-office" type="submit" value="Save">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@include('template.admin_footer')
