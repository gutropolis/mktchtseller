<article class="markdown-body entry-content" itemprop="text"><p align="center"><a href="https://camo.githubusercontent.com/5ceadc94fd40688144b193fd8ece2b805d79ca9b/68747470733a2f2f6c61726176656c2e636f6d2f6173736574732f696d672f636f6d706f6e656e74732f6c6f676f2d6c61726176656c2e737667" target="_blank"><img src="https://camo.githubusercontent.com/5ceadc94fd40688144b193fd8ece2b805d79ca9b/68747470733a2f2f6c61726176656c2e636f6d2f6173736574732f696d672f636f6d706f6e656e74732f6c6f676f2d6c61726176656c2e737667" data-canonical-src="https://laravel.com/assets/img/components/logo-laravel.svg" style="max-width:100%;"></a></p>
<p align="center">
<a href="https://travis-ci.org/laravel/framework" rel="nofollow"><img src="https://camo.githubusercontent.com/88861b709123d23a028c2fd3ee2362d4d0a74927/68747470733a2f2f7472617669732d63692e6f72672f6c61726176656c2f6672616d65776f726b2e737667" alt="Build Status" data-canonical-src="https://travis-ci.org/laravel/framework.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/laravel/framework" rel="nofollow"><img src="https://camo.githubusercontent.com/5a674002b5c53d66601b1d59a8ac60353aa96000/68747470733a2f2f706f7365722e707567782e6f72672f6c61726176656c2f6672616d65776f726b2f642f746f74616c2e737667" alt="Total Downloads" data-canonical-src="https://poser.pugx.org/laravel/framework/d/total.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/laravel/framework" rel="nofollow"><img src="https://camo.githubusercontent.com/de9d7ef724aa9d01338f48bfb115a258047e23b6/68747470733a2f2f706f7365722e707567782e6f72672f6c61726176656c2f6672616d65776f726b2f762f737461626c652e737667" alt="Latest Stable Version" data-canonical-src="https://poser.pugx.org/laravel/framework/v/stable.svg" style="max-width:100%;"></a>
<a href="https://packagist.org/packages/laravel/framework" rel="nofollow"><img src="https://camo.githubusercontent.com/e65c945b219ec6c6f63826a83df905b3191ae52c/68747470733a2f2f706f7365722e707567782e6f72672f6c61726176656c2f6672616d65776f726b2f6c6963656e73652e737667" alt="License" data-canonical-src="https://poser.pugx.org/laravel/framework/license.svg" style="max-width:100%;"></a>
</p>
<h2><a href="#about-laravel" aria-hidden="true" class="anchor" id="user-content-about-laravel"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>About Laravel</h2>
<p>Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:</p>
<p align="center"><a href="https://vuejs.org" target="_blank"><img src="https://vuejs.org/images/logo.png" style="max-width:15%;"></a></p>
 
<h2>About Vue.Js</h2>
<p>Vue (pronounced /vjuː/, like view) is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable. The core library is focused on the view layer only, and is easy to pick up and integrate with other libraries or existing projects. On the other hand, Vue is also perfectly capable of powering sophisticated Single-Page Applications when used in combination with modern tooling and supporting libraries.</p>

<h2><a href="#installation" aria-hidden="true" class="anchor" id="user-content-installation"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Installation</h2>
<ul>
<li><code>git clone https://github.com/gutropolis/mktchtseller.git </code></li>
<li><code>cd mktchtseller</code></li>
<li><code>cp .env.example .env</code></li>
<li><code>composer install</code></li>
<li><code>php artisan key:generate</code></li>
<li><code>php artisan jwt:secret</code></li>
<li>Edit <code>.env</code> and set your database connection details</li>
<li><code>php artisan migrate</code></li>
<li><code>npm install</code> / <code>yarn</code></li>
</ul>
<hr />
<ul>
    <li><i class="fa fa-circle-o"></i> Laravel 5.5.x</li>
    <li><i class="fa fa-circle-o"></i> Vue.js 2.5.2</li>
    <li><i class="fa fa-circle-o"></i> Bootstrap 4.0.0 beta</li>
    <li><i class="fa fa-circle-o"></i> jQuery 3.2.0</li>
    <li><i class="fa fa-circle-o"></i> Aixos 0.16.2</li>
</ul>
<hr />
<ul>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/barryvdh/laravel-cors" target="_blank">barryvdh/laravel-cors</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/barryvdh/laravel-dompdf" target="_blank">barryvdh/laravel-dompdf</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/guzzle/guzzle" target="_blank">guzzlehttp/guzzle</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="http://image.intervention.io/" target="_blank">intervention/image</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/laravel/socialite" target="_blank">laravel/socialite</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/mewebstudio/Purifier" target="_blank">mews/purifier</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/Nexmo/nexmo-laravel" target="_blank">nexmo/laravel</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/spatie/laravel-permission" target="_blank">spatie/laravel-permission</a></li>
                                        <li><i class="fa fa-circle-o"></i> <a href="https://github.com/tymondesigns/jwt-auth" target="_blank">tymon/jwt-auth</a></li>
                                    </ul>
                                    
 <p>Here are the npm packages used in this script:</p>
 <ul>
                                        <li><i class="fa fa-circle-o"></i> laravel-mix</li>
                                        <li><i class="fa fa-circle-o"></i> browser-sync</li>
                                        <li><i class="fa fa-circle-o"></i> browser-sync-webpack-plugin</li>
                                        <li><i class="fa fa-circle-o"></i> webpack-bundle-analyzer</li>
                                        <li><i class="fa fa-circle-o"></i> compression-webpack-plugin</li>
                                        <li><i class="fa fa-circle-o"></i> js-cookie</li>
                                        <li><i class="fa fa-circle-o"></i> laravel-vue-pagination</li>
                                        <li><i class="fa fa-circle-o"></i> lodash</li>
                                        <li><i class="fa fa-circle-o"></i> uuid</li>
                                        <li><i class="fa fa-circle-o"></i> v-mask</li>
                                        <li><i class="fa fa-circle-o"></i> v-tooltip</li>
                                        <li><i class="fa fa-circle-o"></i> vue-multiselect</li>
                                        <li><i class="fa fa-circle-o"></i> vue-password-strength-meter</li>
                                        <li><i class="fa fa-circle-o"></i> vue-router</li>
                                        <li><i class="fa fa-circle-o"></i> vue-sortable</li>
                                        <li><i class="fa fa-circle-o"></i> vue-switches</li>
                                        <li><i class="fa fa-circle-o"></i> vuejs-datepicker</li>
                                        <li><i class="fa fa-circle-o"></i> vuejs-dialog</li>
                                        <li><i class="fa fa-circle-o"></i> vuex</li>
                                        <li><i class="fa fa-circle-o"></i> vuex-persistedstate</li>
                                        <li><i class="fa fa-circle-o"></i> zxcvbn</li>
                                    </ul>
 <p> npm install --save-dev laravel-mix browser-sync browser-sync-webpack-plugin webpack-bundle-analyzer compression-webpack-plugin js-cookie laravel-vue-pagination lodash uuid v-mask v-tooltip vue-multiselect vue-password-strength-meter vue-router vue-sortable vue-switches vuejs-datepicker vuejs-dialog vuex vuex-persistedstate
  zxcvbn  </p>                                   
</article>
