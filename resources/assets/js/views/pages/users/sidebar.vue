<template>
   <aside class="col-md-3 proflie__element pr-0">
      <div class="proflie__element--box">
         <figure class="proflie__element--image">
            <img :src="getAvatar" alt="user" /> 
         </figure>
         <h4 class="proflie__element--name">{{getAuthUserFullName()}}</h4>
      </div>
      <div class="proflie__element--detail">
         <ul class="proflie__element--detail--list">
            <li class="proflie__element--detail--list--item">
               <router-link to ="/my_account" class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 486.9 486.9" style="enable-background:new 0 0 486.9 486.9;" xml:space="preserve">
                     <g>
                        <path d="M276.8,364.45c0-19.8,4.9-38.9,14.2-55.9c-13.2-7.4-22.9-12.3-26.9-14.2c-1.2-0.6-2-1.9-2-3.2v-78
                           c9.8-6.5,16.3-17.7,16.3-30.4v-80.9c0-40.3-32.6-72.9-72.9-72.9h-8.7h-8.7c-40.3,0-72.9,32.6-72.9,72.9v80.9
                           c0,12.7,6.5,23.8,16.3,30.4v78c0,1.4-0.8,2.6-2,3.2c-11,5.4-65,32.7-115.2,73.9c-9.1,7.4-14.3,18.6-14.3,30.3v55.4h196.7h121.8
                           c-2.6-2.2-5.2-4.5-7.6-7C288.9,424.95,276.8,395.55,276.8,364.45z"/>
                     </g>
                     <g>
                        <path d="M486.9,358.25c0-4.4-3.5-7.9-7.9-7.9h-12c-1.9-9.9-5.8-19.4-11.7-28l8.5-8.5c3.1-3.1,3.1-8.1,0-11.2l-8.6-8.6
                           c-3.1-3.1-8.1-3.1-11.2,0l-8.5,8.5c-8.6-5.9-18.2-9.7-28.1-11.6v-12c0-4.4-3.5-7.9-7.9-7.9h-12.2c-4.4,0-7.9,3.5-7.9,7.9v12
                           c-9.9,1.9-19.5,5.7-28.2,11.6l-8.4-8.4c-3.1-3.1-8.1-3.1-11.2,0l-8.6,8.6c-3.1,3.1-3.1,8.1,0,11.2l8.3,8.3
                           c-6,8.7-9.9,18.3-11.8,28.3h-11.7c-4.4,0-7.9,3.5-7.9,7.9v12.2c0,4.4,3.5,7.9,7.9,7.9h11.6c1.9,10,5.8,19.7,11.8,28.4l-8.2,8.2
                           c-3.1,3.1-3.1,8.1,0,11.2l8.6,8.6c3.1,3.1,8.1,3.1,11.2,0l8.2-8.2c8.7,5.9,18.4,9.8,28.4,11.7v11.6c0,4.4,3.5,7.9,7.9,7.9h12.2
                           c4.4,0,7.9-3.5,7.9-7.9v-11.7c10-1.9,19.6-5.9,28.3-11.8l8.3,8.3c3.1,3.1,8.1,3.1,11.2,0l8.6-8.6c3.1-3.1,3.1-8.1,0-11.2
                           l-8.4-8.4c5.9-8.7,9.7-18.3,11.6-28.2h12c4.4,0,7.9-3.5,7.9-7.9L486.9,358.25z M422.3,393.15c-15.9,15.9-41.6,15.9-57.5,0.1
                           c-15.9-15.9-15.9-41.6-0.1-57.5c15.9-15.9,41.6-15.9,57.5-0.1C438.2,351.45,438.2,377.25,422.3,393.15z"/>
                     </g>
                  </svg>
                  My Profile
               </router-link>
            </li>
            <div v-if="getrole === 'charity'">
			<li class="proflie__element--detail--list--item">
                  <router-link to="" v-b-toggle.collapse3 class="proflie__element--detail--list--item--link">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px">
                        <g>
                           <g>
                              <path d="M486.647,391.189c-51.2-26.948-90.359-41.899-125.133-47.812l3.789-5.205c1.485-2.039,1.988-4.634,1.374-7.083    l-7.919-31.684c21.222-29.935,33.775-67.328,33.775-102.784v-59.733C392.533,61.606,331.281,0.354,256,0.354    S119.467,61.606,119.467,136.887v59.733c0,35.456,12.553,72.849,33.775,102.784l-7.919,31.684    c-0.614,2.449-0.111,5.043,1.374,7.083l3.789,5.205c-34.773,5.914-73.933,20.864-125.133,47.812    C9.719,399.415,0,415.509,0,433.207v69.905c0,4.719,3.823,8.533,8.533,8.533h204.8h0.008l84.924-0.077    c0.137,0.009,0.265,0.077,0.401,0.077h204.8c4.71,0,8.533-3.814,8.533-8.533v-69.905C512,415.509,502.281,399.415,486.647,391.189    z M136.533,196.621v-59.733c0-65.877,53.589-119.467,119.467-119.467S375.467,71.01,375.467,136.887v59.733    c0,38.426-13.594,72.243-33.698,97.604c-0.307,0.29-0.691,0.478-0.947,0.802c-2.935,3.755-5.973,7.296-9.105,10.624    c-0.017,0.017-0.034,0.034-0.051,0.051c-2.065,2.202-4.233,4.156-6.374,6.161c-20.855,18.799-45.636,29.824-69.291,29.824    c-23.654,0-48.435-11.025-69.291-29.824c-2.142-2.005-4.309-3.959-6.374-6.161c-0.017-0.017-0.034-0.034-0.051-0.051    c-3.132-3.328-6.17-6.869-9.105-10.624c-0.256-0.324-0.64-0.512-0.947-0.802C150.127,268.864,136.533,235.046,136.533,196.621z     M277.001,418.487h-42.001L256,371.23L277.001,418.487z M162.842,331.354l3.831-15.309c0.026,0.026,0.043,0.043,0.068,0.068    c20.617,22.426,46.857,38.229,76.442,41.822c0.009,0,0.026,0.009,0.043,0.009l-23.151,52.105L162.842,331.354z M222.882,494.571    l6.613-59.017h53.009l0.606,5.402l6.007,53.555L222.882,494.571z M291.925,410.048l-23.151-52.105    c0.009,0,0.026-0.009,0.043-0.009c29.585-3.593,55.825-19.396,76.442-41.822l0.068-0.068l3.823,15.309L291.925,410.048z" fill="#FFFFFF"/>
                           </g>
                        </g>
                     </svg>
                     Charity
                  </router-link>
                  <b-link class="dropdown__arrow" v-b-toggle.collapse3><i class="fa fa-angle-down" aria-hidden="true"></i></b-link>
                  <b-collapse  id="collapse3" class=""  >
                     <ul class="drop_menu">
                        <li class="drop_menu--list">
                           <router-link to="/charity_organisation" class="drop_menu--list--link"><i class="fa fa-angle-right" aria-hidden="true"></i> Add Charity Organization</router-link>
                        </li>
                        <li class="drop_menu--list">
                           <router-link to="/charity_list" class="drop_menu--list--link"><i class="fa fa-angle-right" aria-hidden="true"></i> My Charities</router-link>
                        </li>
                     </ul>
                  </b-collapse>
               </li>
			     <li class="proflie__element--detail--list--item">
               <router-link to="users_detail" v-b-toggle.collapse7 class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
                     <g>
                        <polygon points="169.6,256.3 0,101.5 0,390.4 		"/>
                        <path d="M304.5,270.3l-52.8,48.2c-4.1,3.8-10.5,3.8-14.6,0l-52-48.2l-165.6,131h451L304.5,270.3z"/>
                        <polygon points="244.6,296.7 472.8,88.7 16.4,88.7 		"/>
                        <polygon points="320,256.3 490,390.4 490,101.1 		"/>
                     </g>
                  </svg>
                  Messages <span class="msg_counter" style="margin-left:10px;border-radius:20px;width:20px;height:17px;color:#fff;background-color:orange;padding: 1px 5px;">{{unread_message_charity}}</span> 
               </router-link>
            </li>
               <li class="proflie__element--detail--list--item">
                  <router-link to="/my_ads" class="proflie__element--detail--list--item--link">
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="31.979px" height="31.979px" viewBox="0 0 31.979 31.979" style="enable-background:new 0 0 31.979 31.979;" xml:space="preserve">
                        <g>
                           <path d="M21.945,6.06V5.359c0-0.796-0.646-1.441-1.441-1.441h-2.365c0.197-0.356,0.309-0.797,0.309-1.245
                              C18.447,1.2,17.249,0,15.777,0c-1.472,0-2.669,1.2-2.669,2.673c0,0.448,0.112,0.889,0.309,1.245h-1.94
                              c-0.796,0-1.441,0.645-1.441,1.441V6.06H6.822c-1.207,0-2.185,0.979-2.185,2.186v21.546c0,1.207,0.978,2.187,2.185,2.187h18.334
                              c1.207,0,2.186-0.979,2.186-2.187V8.246c0-1.207-0.979-2.186-2.186-2.186H21.945z M14.187,2.674c0-0.878,0.713-1.594,1.589-1.594
                              c0.878,0,1.591,0.716,1.591,1.594c0,0.502-0.234,0.933-0.6,1.245h-1.981C14.421,3.606,14.187,3.176,14.187,2.674z M25.156,28.492
                              c0,0.742-0.602,1.344-1.344,1.344H8.166c-0.742,0-1.344-0.602-1.344-1.344V9.59c0-0.743,0.602-1.344,1.344-1.344h1.868
                              c0,0.591,0.479,1.071,1.07,1.071h9.769c0.592,0,1.07-0.479,1.07-1.071h1.869c0.741,0,1.344,0.602,1.344,1.344V28.492
                              L25.156,28.492z"/>
                           <circle cx="10.852" cy="13.098" r="1.899"/>
                           <path d="M21.656,12.038H15.18c-0.596,0-1.08,0.475-1.08,1.071c0,0.596,0.483,1.071,1.08,1.071h6.478
                              c0.596,0,1.078-0.475,1.078-1.071C22.736,12.513,22.253,12.038,21.656,12.038z"/>
                           <circle cx="10.852" cy="18.485" r="1.899"/>
                           <path d="M21.656,17.391H15.18c-0.596,0-1.08,0.498-1.08,1.094s0.483,1.092,1.08,1.092h6.478c0.596,0,1.078-0.496,1.078-1.092
                              S22.253,17.391,21.656,17.391z"/>
                           <circle cx="10.852" cy="24.242" r="1.898"/>
                           <path d="M21.656,23.145H15.18c-0.596,0-1.08,0.498-1.08,1.094s0.483,1.092,1.08,1.092h6.478c0.596,0,1.078-0.497,1.078-1.092
                              C22.736,23.643,22.253,23.145,21.656,23.145z"/>
                        </g>
                     </svg>
                     My Requests
                  </router-link>
               </li>
            </div>
           
          
            <div v-if="getrole === 'charity'">
			 <li class="proflie__element--detail--list--item">
               <router-link to="/my_notification" class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="535.5px" height="535.5px" viewBox="0 0 535.5 535.5" style="enable-background:new 0 0 535.5 535.5;" xml:space="preserve">
                     <g id="notifications-on">
                        <path d="M142.8,53.55l-35.7-35.7C45.9,63.75,5.1,135.15,0,216.75h51C56.1,147.9,89.25,89.25,142.8,53.55z M484.5,216.75h51
                           c-5.1-81.6-43.35-153-104.55-198.9l-35.7,35.7C446.25,89.25,479.4,147.9,484.5,216.75z M433.5,229.5
                           c0-79.05-53.55-142.8-127.5-160.65V51c0-20.4-17.85-38.25-38.25-38.25c-20.4,0-38.25,17.85-38.25,38.25v17.85
                           C155.55,86.7,102,150.45,102,229.5v140.25l-51,51v25.5h433.5v-25.5l-51-51V229.5z M267.75,522.75c2.55,0,7.65,0,10.2,0
                           c17.85-2.55,30.6-15.3,35.7-30.6c2.55-5.101,5.1-12.75,5.1-20.4h-102C216.75,499.8,239.7,522.75,267.75,522.75z"/>
                     </g>
                  </svg>
                  Notifications <span class="msg_counter" style="margin-left:10px;border-radius:20px;width:20px;height:17px;color:#fff;background-color:orange;padding: 1px 5px;">{{unread_notification}}</span> 
               </router-link>
            </li>
               <li class="proflie__element--detail--list--item">
                  <router-link to="/donaters" class="proflie__element--detail--list--item--link">
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                        <g>
                           <g>
                              <path d="M336.726,139.002c-0.003-0.003-0.008-0.008-0.01-0.01c-2.999-2.997-6.355-5.425-9.933-7.288
                                 c3.455-6.05,5.338-12.892,5.406-20.006c0.104-10.977-4.087-21.27-11.805-28.988c-0.003-0.003-0.006-0.006-0.008-0.008
                                 c-3.377-3.375-7.216-6.017-11.318-7.942c2.127-4.979,3.253-10.382,3.255-15.958c0.004-10.862-4.222-21.071-11.902-28.751
                                 c-0.003-0.003-0.006-0.006-0.008-0.008c-12.658-12.649-31.652-15.184-46.87-7.631c-1.93-3.84-4.474-7.393-7.601-10.521
                                 c-0.003-0.003-0.007-0.007-0.01-0.01c-15.856-15.845-41.66-15.84-57.524,0.012l-79.922,79.87l0.026,0.026l-9.663,9.66
                                 L98.84,52.287c0.001-22.354-18.186-40.541-40.539-40.539h-0.108c-22.354,0-40.539,18.186-40.539,40.539l0.001,130.972
                                 c-11.617,14.389-17.845,32.222-17.65,50.853c0.218,20.787,8.413,40.31,23.081,54.976c0.005,0.006,0.012,0.012,0.017,0.017
                                 l54.486,54.449c18.053,18.041,42.768,25.466,66.396,22.339l0.496-145.809c0.126-36.979,25.05-68.333,58.931-78.283l68.798-68.749
                                 l21.208,21.22l-46.796,46.763c7.69,1.967,15.021,5.054,21.798,9.182l29.182-29.145l21.211,21.218l-28.065,28.029
                                 c4.464,5.83,8.076,12.187,10.775,18.919l41.737-41.709C341.49,144.449,339.306,141.582,336.726,139.002z M166.051,149.328
                                 l-21.207-21.221l79.922-79.87l21.207,21.221L166.051,149.328z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M459.713,413.161l-49.161-0.001l9.661-9.662l0.026,0.026l79.87-79.923c15.852-15.863,15.857-41.667,0.012-57.524
                                 c-0.003-0.003-0.006-0.006-0.01-0.01c-3.128-3.128-6.68-5.671-10.521-7.601c7.552-15.219,5.017-34.212-7.632-46.871
                                 c-0.003-0.003-0.005-0.005-0.008-0.008c-7.679-7.679-17.889-11.906-28.75-11.901c-5.576,0.002-10.979,1.127-15.958,3.255
                                 c-1.924-4.101-4.567-7.94-7.942-11.319c-0.003-0.003-0.005-0.005-0.008-0.008c-7.716-7.716-18.011-11.909-28.987-11.804
                                 c-7.115,0.067-13.957,1.951-20.007,5.405c-1.863-3.577-4.291-6.933-7.288-9.933c-0.004-0.003-0.006-0.006-0.01-0.01
                                 c-2.578-2.578-5.443-4.762-8.521-6.531l-41.748,41.721c6.742,2.698,13.107,6.312,18.945,10.782l28.03-28.066l21.218,21.211
                                 l-29.143,29.181c4.129,6.776,7.217,14.107,9.186,21.796l46.759-46.793l21.22,21.208l-68.737,68.787
                                 c-9.945,33.89-41.303,58.823-78.287,58.948l-145.808,0.497c-3.127,23.626,4.297,48.342,22.338,66.395l54.449,54.486
                                 c0.006,0.006,0.012,0.012,0.018,0.018c14.665,14.665,34.19,22.863,54.976,23.081c18.631,0.195,36.464-6.032,50.853-17.649
                                 l130.972,0.001c22.353-0.002,40.538-18.188,40.538-40.54v-0.106C500.253,431.347,482.066,413.163,459.713,413.161z
                                 M362.665,345.941l79.87-79.923l21.221,21.207l-79.87,79.923L362.665,345.941z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M328.608,249.582c-9.655-9.655-22.525-14.947-36.24-14.9l-15.104,0.052l0.052-15.104
                                 c0.047-13.714-5.244-26.584-14.9-36.24c-9.655-9.655-22.525-14.946-36.24-14.9c-28.408,0.097-51.598,23.287-51.694,51.694
                                 l-0.4,117.733l117.732-0.401c28.408-0.096,51.598-23.286,51.694-51.694C343.555,272.108,338.263,259.238,328.608,249.582z"/>
                           </g>
                        </g>
                     </svg>
                     Donation Lists
                  </router-link>
               </li>
               
            </div>
            <div v-else>
			 <li class="proflie__element--detail--list--item">
               <router-link to="users_detail" v-b-toggle.collapse7 class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
                     <g>
                        <polygon points="169.6,256.3 0,101.5 0,390.4 		"/>
                        <path d="M304.5,270.3l-52.8,48.2c-4.1,3.8-10.5,3.8-14.6,0l-52-48.2l-165.6,131h451L304.5,270.3z"/>
                        <polygon points="244.6,296.7 472.8,88.7 16.4,88.7 		"/>
                        <polygon points="320,256.3 490,390.4 490,101.1 		"/>
                     </g>
                  </svg>
                  Messages <span class="msg_counter" style="margin-left:10px;border-radius:20px;width:20px;height:17px;color:#fff;background-color:orange;padding: 1px 5px;">{{unread_message_seller}}</span> 
               </router-link>
            </li>
			 <li class="proflie__element--detail--list--item">
               <router-link to="/donation_list" class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="535.5px" height="535.5px" viewBox="0 0 535.5 535.5" style="enable-background:new 0 0 535.5 535.5;" xml:space="preserve">
                     <g id="notifications-on">
                        <path d="M142.8,53.55l-35.7-35.7C45.9,63.75,5.1,135.15,0,216.75h51C56.1,147.9,89.25,89.25,142.8,53.55z M484.5,216.75h51
                           c-5.1-81.6-43.35-153-104.55-198.9l-35.7,35.7C446.25,89.25,479.4,147.9,484.5,216.75z M433.5,229.5
                           c0-79.05-53.55-142.8-127.5-160.65V51c0-20.4-17.85-38.25-38.25-38.25c-20.4,0-38.25,17.85-38.25,38.25v17.85
                           C155.55,86.7,102,150.45,102,229.5v140.25l-51,51v25.5h433.5v-25.5l-51-51V229.5z M267.75,522.75c2.55,0,7.65,0,10.2,0
                           c17.85-2.55,30.6-15.3,35.7-30.6c2.55-5.101,5.1-12.75,5.1-20.4h-102C216.75,499.8,239.7,522.75,267.75,522.75z"/>
                     </g>
                  </svg>
                  Notifications
               </router-link>
            </li>
			<li class="proflie__element--detail--list--item">
                  <router-link to="/product" class="proflie__element--detail--list--item--link">
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="510px" height="510px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                        <g>
                           <g id="shopping-cart">
                              <path d="M153,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S181.05,408,153,408z M0,0v51h51l91.8,193.8L107.1,306
                                 c-2.55,7.65-5.1,17.85-5.1,25.5c0,28.05,22.95,51,51,51h306v-51H163.2c-2.55,0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7
                                 c20.4,0,35.7-10.2,43.35-25.5L504.9,89.25c5.1-5.1,5.1-7.65,5.1-12.75c0-15.3-10.2-25.5-25.5-25.5H107.1L84.15,0H0z M408,408
                                 c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S436.05,408,408,408z"/>
                           </g>
                        </g>
                     </svg>
                     Add Product
                  </router-link>
               </li>
			   <li class="proflie__element--detail--list--item">
                  <router-link to="/product_list" class="proflie__element--detail--list--item--link">
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                           <g>
                              <path d="M362.658,66.016h-85.312c-5.888,0-10.656,4.928-10.656,11.008S271.426,88,277.346,88h85.344
                                 c5.888,0,10.656-4.928,10.656-11.008S368.578,66.016,362.658,66.016z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M393.378,5.792C391.554,2.24,387.938,0,384.002,0h-128c-3.936,0-7.552,2.24-9.408,5.824
                                 c-1.856,3.552-1.632,7.904,0.544,11.264l22.304,34.528c2.528-0.8,5.088-1.632,7.872-1.632h85.344c2.816,0,5.376,0.8,7.904,1.632
                                 l22.304-34.528C395.042,13.728,395.266,9.376,393.378,5.792z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M48.002,256h-32c-8.832,0-16,7.168-16,16v224c0,8.832,7.168,16,16,16h32c8.832,0,16-7.168,16-16V272
                                 C64.002,263.168,56.834,256,48.002,256z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M501.89,290.528c-16.256-20.96-46.464-24.704-67.328-8.416l-118.016,91.776C308.098,380.448,297.73,384,287.074,384
                                 H176.002c44.192,0,80-35.808,80-80c0-8.832-7.168-16-16-16h-144v96v96h212.992c17.792,0,35.072-5.92,49.12-16.864l135.36-105.28
                                 C514.402,341.6,518.146,311.456,501.89,290.528z"/>
                           </g>
                        </g>
                        <g>
                           <g>
                              <path d="M436.226,228.448l-68.448-125.472c-1.696,0.352-3.264,1.024-5.088,1.024h-85.344c-1.792,0-3.36-0.704-5.056-1.024
                                 l-68.48,125.472c-4.672,8.576-7.52,17.952-9.44,27.552h45.632c26.464,0,48,21.536,48,48c0,17.152-3.904,33.44-10.816,48h9.888
                                 c3.584,0,6.976-1.152,9.824-3.36l118.016-91.776c8.16-6.368,17.376-10.912,27.072-13.696
                                 C440.258,238.176,438.754,233.088,436.226,228.448z"/>
                           </g>
                        </g>
                     </svg>
                      Product List
                  </router-link>
               </li>
              
               
               <li class="proflie__element--detail--list--item">
                  <router-link to="" v-b-toggle.collapse5 class="proflie__element--detail--list--item--link">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px">
                        <g>
                           <g>
                              <path d="M486.647,391.189c-51.2-26.948-90.359-41.899-125.133-47.812l3.789-5.205c1.485-2.039,1.988-4.634,1.374-7.083    l-7.919-31.684c21.222-29.935,33.775-67.328,33.775-102.784v-59.733C392.533,61.606,331.281,0.354,256,0.354    S119.467,61.606,119.467,136.887v59.733c0,35.456,12.553,72.849,33.775,102.784l-7.919,31.684    c-0.614,2.449-0.111,5.043,1.374,7.083l3.789,5.205c-34.773,5.914-73.933,20.864-125.133,47.812    C9.719,399.415,0,415.509,0,433.207v69.905c0,4.719,3.823,8.533,8.533,8.533h204.8h0.008l84.924-0.077    c0.137,0.009,0.265,0.077,0.401,0.077h204.8c4.71,0,8.533-3.814,8.533-8.533v-69.905C512,415.509,502.281,399.415,486.647,391.189    z M136.533,196.621v-59.733c0-65.877,53.589-119.467,119.467-119.467S375.467,71.01,375.467,136.887v59.733    c0,38.426-13.594,72.243-33.698,97.604c-0.307,0.29-0.691,0.478-0.947,0.802c-2.935,3.755-5.973,7.296-9.105,10.624    c-0.017,0.017-0.034,0.034-0.051,0.051c-2.065,2.202-4.233,4.156-6.374,6.161c-20.855,18.799-45.636,29.824-69.291,29.824    c-23.654,0-48.435-11.025-69.291-29.824c-2.142-2.005-4.309-3.959-6.374-6.161c-0.017-0.017-0.034-0.034-0.051-0.051    c-3.132-3.328-6.17-6.869-9.105-10.624c-0.256-0.324-0.64-0.512-0.947-0.802C150.127,268.864,136.533,235.046,136.533,196.621z     M277.001,418.487h-42.001L256,371.23L277.001,418.487z M162.842,331.354l3.831-15.309c0.026,0.026,0.043,0.043,0.068,0.068    c20.617,22.426,46.857,38.229,76.442,41.822c0.009,0,0.026,0.009,0.043,0.009l-23.151,52.105L162.842,331.354z M222.882,494.571    l6.613-59.017h53.009l0.606,5.402l6.007,53.555L222.882,494.571z M291.925,410.048l-23.151-52.105    c0.009,0,0.026-0.009,0.043-0.009c29.585-3.593,55.825-19.396,76.442-41.822l0.068-0.068l3.823,15.309L291.925,410.048z" fill="#FFFFFF"/>
                           </g>
                        </g>
                     </svg>
                     Seller
                  </router-link>
                  <b-link class="dropdown__arrow" v-b-toggle.collapse5><i class="fa fa-angle-down" aria-hidden="true"></i></b-link>
                  <b-collapse  id="collapse5" class=""  >
                     <ul class="drop_menu">
                        <li class="drop_menu--list">
                           <router-link to="/vender_organisation" class="drop_menu--list--link"><i class="fa fa-angle-right" aria-hidden="true"></i> Add Company</router-link>
                        </li>
                        <li class="drop_menu--list">
                           <router-link to="/seller_list" class="drop_menu--list--link"><i class="fa fa-angle-right" aria-hidden="true"></i> My Companies</router-link>
                        </li>
                        <li class="drop_menu--list">
                           <router-link to="" class="drop_menu--list--link"><i class="fa fa-angle-right" aria-hidden="true"></i> Tax Documents</router-link>
                        </li>
                     </ul>
                  </b-collapse>
               </li>
            </div>
            <li class="proflie__element--detail--list--item">
               <a href="#" @click.prevent="logout" class="proflie__element--detail--list--item--link">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="44.816px" height="44.816px" viewBox="0 0 44.816 44.816" style="enable-background:new 0 0 44.816 44.816;" xml:space="preserve">
                     <g>
                        <path d="M22.404,21.173c2.126,0,3.895-1.724,3.895-3.85V3.849C26.299,1.724,24.53,0,22.404,0c-2.126,0-3.895,1.724-3.895,3.849
                           v13.475C18.51,19.449,20.278,21.173,22.404,21.173z"/>
                        <path d="M30.727,3.33c-0.481-0.2-1.03-0.147-1.466,0.142c-0.434,0.289-0.695,0.776-0.695,1.298v5.113
                           c0,0.56,0.301,1.076,0.784,1.354c4.192,2.407,6.918,6.884,6.918,11.999c0,7.654-6.217,13.882-13.87,13.882
                           c-7.654,0-13.86-6.228-13.86-13.882c0-5.113,2.813-9.589,6.931-11.997c0.478-0.279,0.773-0.794,0.773-1.348V4.769
                           c0-0.521-0.261-1.009-0.695-1.298c-0.435-0.29-0.984-0.342-1.466-0.142C6.257,6.593,0.845,14.276,0.845,23.236
                           c0,11.92,9.653,21.58,21.572,21.58c11.917,0,21.555-9.66,21.555-21.58C43.971,14.276,38.554,6.593,30.727,3.33z"/>
                     </g>
                  </svg>
                  Log Out
               </a>
            </li>
         </ul>
         <div class="contact__btn">
            <router-link to="/contact" class="btn contact__btn--content">Contact</router-link>
         </div>
      </div>
      </tr>
   </aside>
</template>
<script>
   import helper from '../../../services/helper'
   
   export default {
   data() {
   return {
			unread_message_charity:{},
			unread_message_seller:{},
			unread_notification:{},
   
   charity:''		
   }
   },
   
       mounted() {
	   this.fetchmessage_charity();
		   this.fetchmessage_seller();
		 this.fetchnotification();
       },
	   created: function()
           {
		   this.fetchmessage_charity();
		   this.fetchmessage_seller();
				
               this.fetchnotification();
           },
       methods : {
			fetchnotification(){
				axios.get('api/unread_charity_notification').then(response=>{
   			
   			this.unread_notification=response.data;
			console.log("Notification"+this.unread_notification);
   			
   			})
			
			
			},
			
			fetchmessage_charity(){
					axios.get('api/unread_message_charity').then(response=>{
   			
							this.unread_message_charity=response.data;
							
   			
   			})
			
			},
			fetchmessage_seller(){
					axios.get('api/unread_message_seller').then(response=>{
   			
							this.unread_message_seller=response.data;
							
   			
   			})
			
			},
			
			
           logout(){
               helper.logout().then(() => {
                   this.$store.dispatch('resetAuthUserDetail');
                   this.$router.replace('/login')
   	   window.location.reload();
               })
           },
           getAuthUserFullName(){
               return this.$store.getters.getAuthUserFullName;
           },
   getAuthUserrole(){
               return this.$store.getters.getAuthUserrole;
           },
           getAuthUser(name){
               return this.$store.getters.getAuthUser(name);
           }
       },
       computed: {
   getrole(){
   	return this.getAuthUser('role');
   },
           getAvatar(){
               return '/images/user/'+this.getAuthUser('avatar');
           }
       }
   }
</script>