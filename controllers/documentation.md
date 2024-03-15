```PHP
@api (method) defines the stable public methods, which won’t change their semantics up to the next major release.

@author (in any place) defines the name or an email of the author who wrote the following code.

@copyright (in any place) is used to put your copyright in the code.

@deprecated (in any place) is a useful tag which means that this element will disappear in the next versions. Usually there is a comment with the code you should use instead. Also, most of the IDE highlight places where old methods are used. When it is necessary to clean the out-of-date code for the new release, it will be easy to search by this tag.

@example (in any place) is used for inserting a link to a file or a web page where the example of code usage is shown. Currently phpDocumentor claims that this tag is not fully supported.

@filesource (file) is a tag which you can place only at the very beginning of the php file because you can apply this tag only to a file and to include all code to the generated documentation.

@global (variable) — at this moment this tag is not supported, may be it will be implemented in the next versions when it is updated and reworked.

@ignore (any place) — a dockblock with this tag won’t be processed when generating documentation, even if there are other tags.

@internal (any place) — often used with tag @api, to show that the code is used by inner logic of this part of the program. Element with this tag won’t be included in the documentation.

@license (file, class) shows the type of license of the written code.

@link (any place) is used for adding links but according to the documentation this tag is not fully supported.

@method (class) is applied to the class and describes methods processed with function __call().

@package (file, class) divides code into logical subgroups. When you place classes in the same namespace, you indicate their functional similarity. If classes belong to different namespaces but have the same logical characteristic, they can be grouped using this tag (for example this is the case with classes that all work with customer’s cart but belong to different namespaces). But it is better to avoid such situation. For example, Symfony code style doesn’t use this tag.

@param (method, function) describes the incoming function parameters. It’s worth noticing that if you describe the incoming parameters for a certain function using dockblocks, you have to describe all parameters, not only one or two.

@property (class) — as well as @method this tag is placed in the dockblock of the class, but its function is to describe the properties accessed with the help of magic functions __get() and __set().

@property-read, @property-write (class) are similar to the previous tag but they process only one magic method __get() or __set().

@return (method, function) is used for describing value returned by the function. You can specify its type and PhpStorm will pick it and give you different tips, but let’s talk about this later.

@see (any place) — using this tag you can insert links on external resources (just like with @link), but it also allows to put relative links to classes and methods..

@since (any place) — you can indicate the version in which the piece of code appeared.

@source (any place, except the beginning) — with the help of this tag you can place pieces of the source code in the documentation (you set the beginning and the end code line)

@throws (method function) is used for specifying exceptions which can be called out by this function.

@todo (any place) — the most optimistic tag used by programmers as a reminder of what need to be done in a certain piece of code. IDEhave an ability to detect this tag and group all parts of the code in a separate window which is very convenient for further search. This is the working standard and is used very often.

@uses (any place) is used for displaying the connection between different sections of code. It is similar to @see. The difference is that @see creates unidirectional link and after you go to a new documentation page you won’t have a backward link while @uses gives you a backward navigation link.

@var (variable) is used to specify and to describe variables similar to those used inside the functions and for the class properties. You should distinguish this tag and @param. Tag @param is used only in dockblocks for functions and describes the incoming parameters and @var is used to describe variables.

@version (any place) denotes the current program version in which this class, method, etc. appeares.
```