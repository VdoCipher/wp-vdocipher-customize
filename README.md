Hooks and filters using which to extend VdoCipher plugin on your WordPress website

This is a boilerplate app, that you can modify according to your requirements

Hooks
vdocipher_customize_player

Filters
vdocipher_add_shortcode_attributes

Using this filter you can add your own attributes to the shortcode

vdocipher_annotate_preprocess
Use this filter to display custom user information - before any processing by the vdocipher plugin itself

vdocipher_annotate_postprocess
Use this filter to display custom user information - after the vdocipher plugin has processed {name}, {email}, {username}, {id}, {ip}, and {date}

vdocipher_modify_otp_request
Use this to send additional OTP body specifications, as can be found here:https://dev.vdocipher.com/api/docs/book/playbackauth/reqbody.html
