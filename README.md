<h1>Extend VdoCipher plugin</h1>

<p>Using this plugin you can extend the VdoCipher WordPress plugin. This plugin requires the VdoCipher WordPress plugin to be installed.</p>
<p>In this plugin, we provide functions for two use cases:</p>
<ul>
  <li>Adding Chapters links over the player, so that user can skip ahead to the relevant time in the video</li>
  <li>Add custom watermark attributes</li>
</ul>
<p>These remain the most common requirements from our users. If you have any additional requirements you should be able to go through the functions given here and tweak them according to your requirement, or else contact our support team at VdoCipher.</p>

<h3>Hooks</h3>
<h4><code>vdocipher_customize_player</code></h4>
<p>All functions attached to this hook run at the very end of the vdocipher shortcode parsing.</p>

<h3>Filters</h3>
<h4><code>vdocipher_add_shortcode_attributes</code></h4>
<p>Using this filter you can add your own attributes to the shortcode</p>
<h4><code>vdocipher_annotate_preprocess</code></h4>
<p>Use this filter to display custom user information - before any processing by the vdocipher plugin itself</p>
<h4><code>vdocipher_annotate_postprocess</code></h4>
<p>Use this filter to display custom user information - after the vdocipher plugin has processed {name}, {email}, {username}, {id}, {ip}, and {date}</p>
<h4><code>vdocipher_modify_otp_request</code></h4>
<p>Use this to send additional OTP body specifications, as can be found here:https://dev.vdocipher.com/api/docs/book/playbackauth/reqbody.html</p>

<h2>Use Cases</h2>
<p>The following class should always be included:<code>classes/vdocipher-customize-essentials.php</code>. It enqueues the files <code>js/vdocipherapiready.js</code> and <code>styles/overlay.css</code>. You can add all custom css in the <code>overlay.css</code> file. Make sure that all css classes are preceded by <code>.vc-container</code> selector</p>
<h3>Add Chapters</h3>
<ol>
  <li>Make sure that <code>classes/vdocipher-add-chapters.php</code> is included in the main plugin file</li>
  <li>The function <code>new_vdo_shortcode_attribute</code> adds a new attribute to the vdocipher shortcode - <code>chapters</code>. This function is hooked to the filter <code>vdocipher_add_shortcode_attributes</code></li>
  <li>The value given to the attribute is then processed in <code>insert_chapters</code> and <code>insert_chapters_with_names</code> function. <strong>Please use only one of these functions.</strong> All the functions are called by attaching them to VdoCipher hooks and filters, in the class constructor of <code>VdoCipherAddChapters</code> class. Uncomment the function that you would like to use. </li>
  <li><code>insert_chapters</code> takes comma separated time values, and outputs list of chapters over the video, with chapters labelled as <em>Chapter 1</em>, <em>Chapter 2</em> and so on. The usage is
    <pre>[vdo id="1234567890" chapters="500,700,1000"]</pre>
  Each of the comma separated values is the duration in the video in seconds that clicking the button will seek to</li>
    <li>In the <code>insert_chapters_with_names</code> function, the chapters attribute takes in chapter names and the time to seek as input. The format is
      <pre>[vdo id="1234567890" chapters="Chapter 1, 500; Chapter 2, 700; Chapter 3, 1000"]</pre>
    Chapter name and Chapter time in seconds are separated by comma, different chapter values are separated by semi-colons.
    </li>
</ol>
<p><<strong>Please use only one of these two functions</strong>These two functions <code>insert_chapters</code> and <code>insert_chapters_with_names</code> are presented here for completeness. If there is any code here that you do not require, you are free to remove it. We have implemented the child theme - theme framework architecture, so that you can freely extend the VdoCipher plugin without having to worry about breaking changes when the main VdoCipher plugin updates</p>
