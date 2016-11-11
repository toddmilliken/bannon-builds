require 'compass'
environment = :production
preferred_syntax = :sass
http_path = '/'
css_dir = 'css'
sass_dir = 'sass'
images_dir = 'images'
javascripts_dir = 'js'
relative_assets = true
line_comments = (environment == :production) ? false : true
output_style = (environment == :production) ? :compressed : :expanded