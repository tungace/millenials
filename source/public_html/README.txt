The Mihalism Multi Host template engine is a very easy system 
to use. These notes will present you with helpful information 
if you are going to be editing or making your own templates.

Template files (.tpl) can store a single template or multiple 
templates. If there is more then one template in a template file,
then each template should be represented by the <template> tag. 
The ID attribute of the <template> tag is used to identify 
itself so that Mihalism Multi Host can fetch the correct 
template. Template IDs are only required to be unique in 
the template file that they are placed in.

If there is a single template stored in a template file, then
there is no need need for the <template> because any code within 
the file will be parsed by the template engine, unless blocked out 
by the <$ $> comment blocks. If there are multiple templates, then
anything outside the <template> tags will not be parsed.

In the templates, place holder variables that will be parsed by 
the template engine are represented by the <# *VARIABLE NAME* #> 
identifiers.
