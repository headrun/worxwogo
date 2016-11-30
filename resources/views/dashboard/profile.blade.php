<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="{{url()}}/assets/favicon/favicon.ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <title>Worxogo</title>
  <link rel="manifest" href="/worxogo/manifest.json">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Worxogo">
  <link rel="apple-touch-icon" href="/worxogo/images/icons/worxogo.png">
  <meta name="msapplication-TileImage" content="/worxogo/images/icons/worxogo.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
  
  
  <link rel="stylesheet" href="{{url()}}/assets/css/inline.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/font-awesome.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/master.css">
  <link rel="stylesheet" href="{{url()}}/assets/css/profile.css">
</head>
<body class="bodydata">
  <header class="header">
    
        <!-- header -->
        
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <label class="pageheading"></label>
                        <h4 class="text-center"><label  class="headingname">Profile Info</label></h4>
                        <h5 class="text-center"><label class=""></label></h5>
                    </div>
                </div>
                <div class="nav navbar-nav navbar-left">
                    <a class="" href="{{url()}}/dashboard/index">
                        <img src="{{url()}}/assets/img/logo/{{$client_data['id']}}{{$client_data['client_logo_ext']}}" class="logo-small " />
                    </a>
                    <label id="lastupdate"><em>Last update: <br class="visible-xs"><span class='lastupdate'></span></em></label>
                </div>
                
                <div class="nav navbar-nav navbar-right text-right">
                    <span >
                    <a class="navbar-right" href="{{url()}}/vault/logout">
                        <i class="fa fa-sign-out text-right signout" aria-hidden="true" >
                        <br>
			<h5 class="dateremaining " >
                             <span class="monthyear"></span>,<br class="visible-xs">
                         Days Left:
                         <span class="daysremaining"> </span>
                        </h5> 
                         
                        </i>
                    </a>
                    </span>
                </div>
            </div>
        </nav>
		<div class="container-fluid">
			<div class="row leaderboard-toolbar">
			<h4 class="text-center toolbar "></h4>
			</div>
		</div>
  </header>

  <main class="main "  >
    <div class="container-fluid cards" hidden >
       <br>
        <h4 class="text-center username"></h4>
	<div id="exTab3" class="container">	
                <ul  class="nav nav-pills">
                    <li class="active">
                        <a  class="link" href="#1b" data-toggle="tab"><h5>Badges</h5></a>
                    </li>
                    <li><a class="link" href="#2b" data-toggle="tab"><h5>Game Card</h5></a>
                    </li>
                    <li><a class="link" href="#3b" data-toggle="tab"><h5>Profile</h5></a>
                    </li>
                </ul>

		<div class="tab-content clearfix">
                    <div class="tab-pane active" id="1b">
                        <h4 class="stillbadge">You are still to Win your 1st badge</h4>
                        <div class="row badgeimgs">
                        </div>
                       
                    </div>
                    <?php if(Session::get('clientId')=='45'){ ?>
                    <div class="tab-pane" id="2b">
                        <h5>How to Earn Points ?</h5>
                        <table class="table-condensed table-responsive" width="100%" > 
                            <thead class="tableheading">
                                <tr>
                                <th>Sr</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>1</td>
                                    <td>MSP (Value)</td>
                                    <td>Every % achievement of MSP (in Rs. Lacs) against the monthly target</td>
                                    <td class="text-right">20</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">2</td>
                                    <td rowspan="2">Category Mix – Truck (Qty)</td>
                                    <td>If the percentage target achievement for the truck category is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr class="color-lightgrey">
                                        <td>If the percentage target achievement for the truck category is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr >
                                    <td rowspan="2">3</td>
                                    <td rowspan="2">Category Mix Non–Truck (Qty)</td>
                                    <td>If the percentage target achievement for the non-truck category is between 50-69%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr>
                                        <td>If the percentage target achievement for the non-truck category is greater than 70%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">4</td>
                                    <td rowspan="2">Category Mix – 2/3 Wheelers (Qty)</td>
                                    <td>If the percentage target achievement for the 2/3 wheeler category is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr style="background-color:lightgrey;">
                                        <td>If the percentage target achievement for the 2/3 wheeler category is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Petro/OE</td>
                                    <td>For every Petro or OE dealer appointed</td>
                                    <td class="text-right">1000</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>6</td>
                                    <td>New/PTP/Steel Wheel</td>
                                    <td>For every New, PTP or Steel Wheel dealer appointed</td>
                                    <td class="text-right">2000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>SAS</td>
                                    <td>Every % increment in SAS against the year beginning value</td>
                                    <td class="text-right">100</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">8</td>
                                    <td rowspan="2">PJP</td>
                                    <td>If PJP adherence on a daily basis is between 80-89%</td>
                                    <td class="text-right">50</td>
                                </tr>
                                    <tr class="color-lightgrey">
                                        <td>If PJP adherence on a daily basis is between 90-100%</td>
                                        <td class="text-right">100</td>
                                    </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td colspan="3">MSP, SAS & Dealer appointments – No Cap</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        * SAS calculation basis: % = (End of week SAS – Beginning of week SAS)/(Base SAS as on April 1, 2016)
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                   For points to be awarded, current value has to be greater than base value
                            
                                    </td>
                                </tr>
                        </table>
                        <br>
                        
                        
                    </div>
                    <?php }else{?>
                    <div class="tab-pane" id="2b">
                        <h5>How to Earn Points ?</h5>
                        <table class="table-condensed table-responsive" width="100%" > 
                            <thead class="tableheading">
                                <tr>
                                <th>Sr</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>1</td>
                                    <td>Sales Value</td>
                                    <td>Every % achievement of MSP (in Rs. Lacs) against the monthly target</td>
                                    <td class="text-right">20</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">2</td>
                                    <td rowspan="2">Sales Quantity Category -1</td>
                                    <td>If the percentage target achievement for the Category 1 is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr class="color-lightgrey">
                                        <td>If the percentage target achievement for the Category 1 is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr >
                                    <td rowspan="2">3</td>
                                    <td rowspan="2">Category -2</td>
                                    <td>If the percentage target achievement for the Category 2 is between 50-69%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr>
                                        <td>If the percentage target achievement for the Category 2 is greater than 70%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">4</td>
                                    <td rowspan="2">Conversion Rate</td>
                                    <td>If the Conversion Rate is between 70-89%</td>
                                    <td class="text-right">200</td>
                                </tr>
                                    <tr style="background-color:lightgrey;">
                                        <td>If the Conversion Rate is greater than 90%</td>
                                        <td class="text-right">500</td>
                                    </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Market Activities</td>
                                    <td>For every Market activity conducted</td>
                                    <td class="text-right">1000</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>6</td>
                                    <td>Dealer Appointment</td>
                                    <td>For every New dealer appointed</td>
                                    <td class="text-right">2000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Dealer Investment Growth</td>
                                    <td>Every % increment in Dealer Investment </td>
                                    <td class="text-right">100</td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td rowspan="2">8</td>
                                    <td rowspan="2">Beat Plan</td>
                                    <td>If Beat Plan adherence on a daily basis is between 80-89%</td>
                                    <td class="text-right">50</td>
                                </tr>
                                <tr class="color-lightgrey">
                                        <td>If Beat Plan adherence on a daily basis is between 90-100%</td>
                                        <td class="text-right">100</td>
                                </tr>
                                    
                                
                        </table>
                        <br>
                        
                        
                    </div>

                    <?php } ?>
                    <div class="tab-pane" id="3b">
                        <table class="table-condensed table-responsive" width="100%">
                            <thead>
                                <tr class="tableheading color-white">
                                    <th>sr</th>
                                    <th>Particular</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>1</td>
                                    <td>Mobile-Number</td>
                                    <td class="mobileno"></td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>2</td>
                                    <td>Job-Role</td>
                                    <td class="designation"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Territory</td>
                                    <td class="territory"></td>
                                </tr>
                                <tr class="color-lightgrey">
                                    <td>4</td>
                                    <td>Region</td>
                                    <td class="region"></td>
                                </tr>
                            </tbody>
                        </table> 
                          
                            
                    </div>
                </div>
            </div>
            <br><br>
    </div>
  </main>
    
<badge hidden>
    <div class=" badgetemplate col-lg-3 col-md-4 col-sm-4 col-xs-4 text-center">
        <img class="badges"  />
        <br>
        <h5 class="text-center badgename" ></h5>
    </div>
</badge>

  <div class="loader">
    <svg viewBox="0 0 32 32" width="32" height="32">
      <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
    </svg>
  </div>

  <!-- Insert link to app.js here -->
  <script> var apiurl= "{{url()}}";</script>
  <script src="{{url()}}/assets/js/jquery.js" ></script>
  <script src="{{url()}}/assets/js/bootstrap.min.js" ></script>
  <script type="text/javascript" src="{{url()}}/assets/js/loader.js"></script>
  <script src="{{url()}}/assets/js/profile.js" async ></script>
  
</body>
</html>