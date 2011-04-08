This bundle provides a mechanism to serve XHTML content with a [proper][1] mime
type if the browser accepts content served as XML.

Installation
============
1. Add the bundle to the autoloader:
       // add the bundle source to your autoload.php
       $loader->registerNamespaces(array('DeBaasMedia' => __DIR__ . '/../vendor/bundles'
                                        ));
2. Register your bundle in the kernel:
       // add this to your
       public function registerBundles ()
       {
         return array(// all the framework bundles
                     ,new DeBaasMedia\Bundle\XhtmlBundle\DeBaasMediaXhtmlBundle
                     );
       }

Known Issues
============
- Incompatible with [AsseticBundle][2] when configured with `use_controller`.

Documentation
=============
Enabling the bundle should be sufficient for most default setups. If however you
wish to configure the extension further you should refer to the full (configuration)
[documentation][3] distributed with this bundle.

License
=======
The bundle is released under the MIT license. For more information see the
[license][4] file distibuted with this bundle.

[1]: http://hixie.ch/advocacy/xhtml
[2]: http://github.com/symfony/symfony/tree/master/src/Symfony/Bundle/AsseticBundle
[3]: ./Resources/doc/index.rst
[4]: ./Resources/meta/LICENSE