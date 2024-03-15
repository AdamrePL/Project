# Informacje do dokumentacji kodu

## **PHP**

> [Więcej o dokumentacji PHP](https://docs.phpdoc.org/3.0/guide/references/phpdoc/basic-syntax.html "phpDocumentor")
```PHP
/** 
 * 
 * @api (method) defines the stable public methods, which won’t change their semantics up to the next major release.
 * 
 * @author (in any place) defines the name or an email of the author who wrote the following code.
 * 
 * @copyright (in any place) is used to put your copyright in the code.
 * 
 * @deprecated (in any place) is a useful tag which means that this element will disappear in the next versions. Usually there is a comment with the code you should use instead. Also, most of the IDE highlight places where old methods are used. When it is necessary to clean the out-of-date code for the new release, it will be easy to search by this tag.
 * 
 * @example (in any place) is used for inserting a link to a file or a web page where the example of code usage is shown. Currently phpDocumentor claims that this tag is not fully supported.
 * 
 * @filesource (file) is a tag which you can place only at the very beginning of the php file because you can apply this tag only to a file and to include all code to the generated documentation.
 * 
 * @global '(variable)' — at this moment this tag is not supported, may be it will be implemented in the next versions when it is updated and reworked.
 * 
 * @ignore (any place) — a dockblock with this tag won’t be processed when generating documentation, even if there are other tags.
 * 
 * @internal (any place) — often used with tag @api, to show that the code is used by inner logic of this part of the program. Element with this tag won’t be included in the documentation.
 * 
 * @license (file, class) shows the type of license of the written code.
 * 
 * @link (any place) is used for adding links but according to the documentation this tag is not fully supported.
 * 
 * @method (class) is applied to the class and describes methods processed with function __call().
 * 
 * @package (file, class) divides code into logical subgroups. When you place classes in the same namespace, you indicate their functional similarity. If classes belong to different namespaces but have the same logical characteristic, they can be grouped using this tag (for example this is the case with classes that all work with customer’s cart but belong to different namespaces). But it is better to avoid such situation. For example, Symfony code style doesn’t use this tag.
 * 
 * @param '(method, function)' describes the incoming function parameters. It’s worth noticing that if you describe the incoming parameters for a certain function using dockblocks, you have to describe all parameters, not only one or two.
 * 
 * @property '(class)' — as well as @method this tag is placed in the dockblock of the class, but its function is to describe the properties accessed with the help of magic functions __get() and __set().
 * 
 * @property-read, @property-write '(class)' are similar to the previous tag but they process only one magic method __get() or __set().
 * 
 * @return '(method, function)' is used for describing value returned by the function. You can specify its type and PhpStorm will pick it and give you different tips, but let’s talk about this later.
 * 
 * @see (any place) — using this tag you can insert links on external resources (just like with @link), but it also allows to put relative links to classes and methods..
 * 
 * @since (any place) — you can indicate the version in which the piece of code appeared.
 * 
 * @source (any place, except the beginning) — with the help of this tag you can place pieces of the source code in the documentation (you set the beginning and the end code line)
 * 
 * @throws '(method function)' is used for specifying exceptions which can be called out by this function.
 * 
 * @todo (any place) — the most optimistic tag used by programmers as a reminder of what need to be done in a certain piece of code. IDEhave an ability to detect this tag and group all parts of the code in a separate window which is very convenient for further search. This is the working standard and is used very often.
 * 
 * @uses (any place) is used for displaying the connection between different sections of code. It is similar to @see. The difference is that @see creates unidirectional link and after you go to a new documentation page you won’t have a backward link while @uses gives you a backward navigation link.
 * 
 * @var '(variable)' is used to specify and to describe variables similar to those used inside the functions and for the class properties. You should distinguish this tag and @param. Tag @param is used only in dockblocks for functions and describes the incoming parameters and @var is used to describe variables.
 * 
 * @version (any place) denotes the current program version in which this class, method, etc. appeares.
*/
```

## **JS**

> [Więcej o dokumentacji JS](https://jsdoc.app/ "@use JSDoc")
```JS
/**
 * 
 * @abstract (synonyms: @virtual)
 * This member must be implemented (or overridden) by the inheritor.
 * 
 * @access
 * Specify the access level of this member (private, package-private, public, or protected).
 * 
 * @alias
 * Treat a member as if it had a different name.
 * 
 * @async
 * Indicate that a function is asynchronous.
 * 
 * @augments (synonyms: @extends)
 * Indicate that a symbol inherits from, and adds to, a parent symbol.
 * 
 * @author
 * Identify the author of an item.
 * 
 * @borrows
 * This object uses something from another object.
 * 
 * @class (synonyms: @constructor)
 * This function is intended to be called with the "new" keyword.
 * 
 * @classdesc
 * Use the following text to describe the entire class.
 * 
 * @constant (synonyms: @const)
 * Document an object as a constant.
 * 
 * @constructs
 * This function member will be the constructor for the previous class.
 * 
 * @copyright
 * Document some copyright information.
 * 
 * @default (synonyms: @defaultvalue)
 * Document the default value.
 * 
 * @deprecated
 * Document that this is no longer the preferred way.
 * 
 * @description (synonyms: @desc)
 * Describe a symbol.
 * 
 * @enum
 * Document a collection of related properties.
 * 
 * @event
 * Document an event.
 * 
 * @example
 * Provide an example of how to use a documented item.
 * 
 * @exports
 * Identify the member that is exported by a JavaScript module.
 * 
 * @external (synonyms: @host)
 * Identifies an external class, namespace, or module.
 * 
 * @file (synonyms: @fileoverview, @overview)
 * Describe a file.
 * 
 * @fires (synonyms: @emits)
 * Describe the events this method may fire.
 * 
 * @function (synonyms: @func, @method)
 * Describe a function or method.
 * 
 * @generator
 * Indicate that a function is a generator function.
 * 
 * @global
 * Document a global object.
 * 
 * @hideconstructor
 * Indicate that the constructor should not be displayed.
 * 
 * @ignore
 * Omit a symbol from the documentation.
 * 
 * @implements
 * This symbol implements an interface.
 * 
 * @inheritdoc
 * Indicate that a symbol should inherit its parent's documentation.
 * 
 * @inner
 * Document an inner object.
 * 
 * @instance
 * Document an instance member.
 * 
 * @interface
 * This symbol is an interface that others can implement.
 * 
 * @kind
 * What kind of symbol is this?
 * 
 * @lends
 * Document properties on an object literal as if they belonged to a symbol with a given name.
 * 
 * @license
 * Identify the license that applies to this code.
 * 
 * @listens
 * List the events that a symbol listens for.
 * 
 * @member (synonyms: @var)
 * Document a member.
 * 
 * @memberof
 * This symbol belongs to a parent symbol.
 * 
 * @mixes
 * This object mixes in all the members from another object.
 * 
 * @mixin
 * Document a mixin object.
 * 
 * @module
 * Document a JavaScript module.
 * 
 * @name
 * Document the name of an object.
 * 
 * @namespace
 * Document a namespace object.
 * 
 * @override
 * Indicate that a symbol overrides its parent.
 * 
 * @package
 * This symbol is meant to be package-private.
 * 
 * @param (synonyms: @arg, @argument)
 * Document the parameter to a function.
 * 
 * @private
 * This symbol is meant to be private.
 * 
 * @property (synonyms: @prop)
 * Document a property of an object.
 * 
 * @protected
 * This symbol is meant to be protected.
 * 
 * @public
 * This symbol is meant to be public.
 * 
 * @readonly
 * This symbol is meant to be read-only.
 * 
 * @requires
 * This file requires a JavaScript module.
 * 
 * @returns (synonyms: @return)
 * Document the return value of a function.
 * 
 * @see
 * Refer to some other documentation for more information.
 * 
 * @since
 * When was this feature added?
 * 
 * @static
 * Document a static member.
 * 
 * @summary
 * A shorter version of the full description.
 * 
 * @this
 * What does the 'this' keyword refer to here?
 * 
 * @throws (synonyms: @exception)
 * Describe what errors could be thrown.
 * 
 * @todo
 * Document tasks to be completed.
 * 
 * @tutorial
 * Insert a link to an included tutorial file.
 * 
 * @type
 * Document the type of an object.
 * 
 * @typedef
 * Document a custom type.
 * 
 * @variation
 * Distinguish different objects with the same name.
 * 
 * @version
 * Documents the version number of an item.
 * 
 * @yields (synonyms: @yield)
 * Document the value yielded by a generator function.
*/
```