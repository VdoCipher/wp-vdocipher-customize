<h1>Extend VdoCipher plugin</h1>

<p>Using this plugin you can extend the VdoCipher WordPress plugin. This plugin requires the VdoCipher WordPress plugin to be installed for it to function.</p>
<p>In this plugin, we provide functions for two use cases:</p>
<ul>
  <li>Adding Chapters links over the player, so that user can skip ahead to the relevant time in the video</li>
  <li>Add custom watermark attributes</li>
</ul>
<p>These remain the most common requirements from our users. If you have any additional requirements you should be able to go through the functions given here and tweak them according to your requirement, or else contact our support team at VdoCipher directly</p>

<h3>Hooks</h3>
<h4><pre>vdocipher_customize_player</pre></h4>
<p>All functions attached to this hook run at the very end of the vdocipher shortcode parsing.</p>

<h3>Filters</h3>
<h4><pre>vdocipher_add_shortcode_attributes</pre></h4>
<p>Using this filter you can add your own attributes to the shortcode</p>
<h4><pre>vdocipher_annotate_preprocess</pre></h4>
<p>Use this filter to display custom user information - before any processing by the vdocipher plugin itself</p>
<h4><pre>vdocipher_annotate_postprocess</pre></h4>
<p>Use this filter to display custom user information - after the vdocipher plugin has processed {name}, {email}, {username}, {id}, {ip}, and {date}</p>
<h4><pre>vdocipher_modify_otp_request</pre></h4>
<p>Use this to send additional OTP body specifications, as can be found here:https://dev.vdocipher.com/api/docs/book/playbackauth/reqbody.html</p>

<h2>Use Cases</h2>
<p>The following class should always be included:<pre>classes/vdocipher-customize-essentials.php</pre>. It enqueues the files <pre>js/vdocipherapiready.js</pre> and <pre>styles/overlay.css</pre>. You can add all custom css in the <pre>overlay.css</pre> file. Make sure that all css classes are preceded by <pre>.vc-container</pre> selector</p>
<h3>Add Chapters</h3>
<ol>
  <li>Make sure that <pre>classes/vdocipher-add-chapters.php</pre> is included in the main plugin file</li>
  <li>The function <pre>new_vdo_shortcode_attribute</pre> internal to the class adds a new attribute to the vdocipher shortcode - chapters. This function is hooked to the filter <pre>vdocipher_add_shortcode_attributes</pre></li>
  <li>The value given to the attribute is then processed in <pre>insert_chapters</pre> and <pre>insert_chapters_with_names</pre> function. Please use only one of these functions. The function is called in the class constructor. Uncomment the function that you would like to use. </li>
  <li><pre>insert_chapters</pre> takes as value comma separated time values, and outputs chapter names as Chapter 1, Chapter 2 and so on. The usage is <br>
    [vdo id="1234567890" chapters="500,700,1000"]<br>
  Where each of the values is the duration in the video (in seconds that the respective chapter will fetch to). You can use this to conveniently just add the time to seek</li>
    <li>In the <pre>insert_chapters_with_names</pre> function, the chapters attribute also takes in chapter names as input as well. The format is <br>
      [vdo id="1234567890" chapters="Chapter 1, 500; Chapter 2, 700; Chapter 3, 1000"]<br>
    Chapter name and Chapter time in seconds are separated by comma, different chapter values are separated by semi-colons.
    </li>
</ol>
<p>These two functions <pre>insert_chapters</pre> and <pre>insert_chapters_with_names</pre> are presented here for completeness. If there is any code here that you do not require, you are free to remove it. We have implemented the child theme - theme framework architecture, so that you can freely extend the VdoCipher plugin without having to worry about breaking changes when the main VdoCipher plugin updates</p>
