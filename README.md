This is a child theme created for the Genesis Framework, intended as a starting point for theme developers. Please do not use this directly in production.

+ **Author:** Gaurav Pareek
+ **Author URI:** [magikpress.com](http://magikpress.com "MagikPress")
+ **Version:** 0.1 

##How to use

1. Install nodejs and npm.
2. Run `sudo npm install grunt-cli`
3. cd to the theme folder, and run `npm install`. This will install all dependencies for the theme.
4. Make changes and run `grunt` to compile the changes.

##Few points
1. All the less files are in `assets/less`. The most important is `app.less`, in which all other less files are imported. There is an index to see what lies in each file. You can just edit whatever files you want in the `partials` folder..
2. You can exclude various less files from the `partial` folder if you don't want them. The standard stylesheet from Genesis is called Genesis.less, so you should exclude it if you plan to write all cs from scratch.
3. All javascript plugins(third-party) will go in `assets/js/vendor`. You can install via bower if you have that installed. You will have to add these in your Gruntfile.js to be included.
4. DO NOT edit style.css directly, IT WILL BE OVERWRITTEN every time you run grunt.

##Grunt tasks
1. Running `grunt` will simply convert less to css, minify and compress all css and js, and generate `main.min.js`, `plugins.min.js` and `style.css`. 
2. If you want to optimize your images, run `grunt imagemin`.
3. Running `grunt watch` will watch the files and will compile as soon as you save the changes.
4. You can set options for deployment in Gruntfile.js and then you can deploy with a single command to your server.

##Credits
1. Takes grunt portions from [https://github.com/mattbanks/Genesis-Starter-Child-Theme/tree/master](https://github.com/mattbanks/Genesis-Starter-Child-Theme/tree/master)
2. Takes portions from [https://github.com/julianfernandes/personal-genesis](https://github.com/julianfernandes/personal-genesis)
3. Takes mixins from Bootstrap [https://github.com/twbs/bootstrap](https://github.com/twbs/bootstrap)

##Support 

**This theme comes with NO support.**

However you can file issues, or drop me a question at [grvrulz@magikpress.com](mailto:grv@magikpress.com "My email"), and I will see if I can answer. You can also [find me on Google Plus](https://plus.google.com/117996111106920866668 "My Google Plus").
