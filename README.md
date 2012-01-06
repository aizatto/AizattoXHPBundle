README
======

I like using Symfony, and I like using [XHP](https://github.com/facebook/xhp/).

So why don't I make it easy to use the too?

Inherit from the :symfony:base class and your classes can access the container.

Example:

<pre>
class :symfony:example extends :symfony:base {

  public function render() {
    $assets = self::$container->get('templating.helper.assets');
  }

}
</pre>

Likewise when you are not running in debug mode, XHP validaton will be turned
off to improve performance.

You can also use this class loader to locate XHP classes in a bundle's Resources
directory.

For example if my bundle was called ExampleBundle, the xhp classes would
stored at "ExampleBundle/Resources/xhp".

You would need to update the bundle itself.
<pre>
use Aizatto\Bundle\XHPBundle\ClassLoader;

class ExampleBundle extends Bundle {

  public function boot() {
    $loader = new ClassLoader('example', __DIR__.'/Resources/xhp');
    $loader->register();
  }

}
</pre>

Therefore any XHP class namespaced at 'example',
will be be found in ExampleBundle/Resources/xhp"

Example:
<pre>
:example:base => ExampleBundle/Resources/xhp/base.php,
:example:article => ExampleBundle/Resources/xhp/article.php,
:example:article:title => ExampleBundle/Resources/xhp/article/title.php,
</pre>

Colon's, dashes, and underscores get converted to a new folder.

This bundle is intended to be used with my own
[XHP](https://github.com/aizatto/xhp) classes.


Installation
------------

### Install source code

You have two options to install the source code.

* deps file
* git submodules

#### Install via deps

Add into your deps file

<pre>
[AizattoXHPBundle]
    git=http://github.com/aizatto/AizattoXHPBundle.git
    target=/bundles/Aizatto/Bundle/XHPBundle
[xhp]
    git=http://github.com/aizatto/xhp.git
    target=/xhp
</pre>

Execute vendor update script:

<pre>
php bin/vendors update
</pre>

#### Install via git submodules

Execute git submodule add command:

<pre>
git submodule add \
  http://github.com/aizatto/AizattoXHPBundle.git \
  vendor/bundles/Aizatto/Bundle/XHPBundle

git submodule add \
  http://github.com/aizatto/xhp.git \
  vendor/xhp
</pre>

### Install into AppKernel

Add "Aizatto\Bundle\XHPBundle\XHPBundle()" to the list of bundles.

<pre>
public function registerBundles()
{
    $bundles = array(
        new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        ...
        new Aizatto\Bundle\XHPBundle\XHPBundle();
    );
</pre>

### Install into autoload

Edit app/autoload.php, and add the register the namespace "Aizatto":

<pre>
$loader->registerNamespaces(array(
  'Aizatto' => __DIR__.'/../vendor/bundles',
))
</pre>

At the bottom of app/autoload.php

<pre>
// XHP
require_once __DIR__.'/../vendor/xhp/src/core/init.php';
require_once __DIR__.'/../vendor/xhp/src/HTML.php';
</pre>
