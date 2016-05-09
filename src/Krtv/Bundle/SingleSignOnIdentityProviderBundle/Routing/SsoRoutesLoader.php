<?php

namespace Krtv\Bundle\SingleSignOnIdentityProviderBundle\Routing;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class SsoRoutesLoader
 * @package Krtv\Bundle\SingleSignOnIdentityProviderBundle\Routing
 */
class SsoRoutesLoader implements LoaderInterface
{
    /**
     * @var string
     */
    private $ssoHost;

    /**
     * @var string
     */
    private $ssoLoginPath;

    /**
     * @var string
     */
    private $ssoLogoutPath;

    /**
     * @var string
     */
    private $ssoHostScheme;

    /**
     * @param string $ssoHost
     * @param string $ssoHostScheme
     * @param string $ssoLoginPath
     * @param string $ssoLogoutPath
     */
    public function __construct($ssoHost, $ssoHostScheme, $ssoLoginPath, $ssoLogoutPath)
    {
        $this->ssoHost = $ssoHost;
        $this->ssoHostScheme = $ssoHostScheme;
        $this->ssoLoginPath = $ssoLoginPath;
        $this->ssoLogoutPath = $ssoLogoutPath;
    }

    /**
     * @param string $resource
     * @param string $type
     * @return RouteCollection
     */
    public function load($resource, $type = null)
    {
        $route1 = new Route($this->ssoLoginPath, array(
            '_controller' => 'KrtvSingleSignOnIdentityProviderBundle:SingleSignOn:ssoLogin'
        ), array(), array(), $this->ssoHost, $this->ssoHostScheme);

        $route2 = new Route($this->ssoLogoutPath, array(
            '_controller' => 'KrtvSingleSignOnIdentityProviderBundle:SingleSignOn:ssoLogout'
        ), array(), array(), $this->ssoHost, $this->ssoHostScheme);

        $routes = new RouteCollection();
        $routes->add('sso_login_path', $route1);
        $routes->add('sso_logout_path', $route2);

        return $routes;
    }

    /**
     * @param string $resource
     * @param string $type
     * @return bool
     */
    public function supports($resource, $type = null)
    {
        return $type === 'sso';
    }

    /**
     * @return void
     */
    public function getResolver()
    {
    }

    /**
     * Irrelevant to us, since we don't need a resolver
     *
     * @param LoaderResolverInterface $resolver
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}
