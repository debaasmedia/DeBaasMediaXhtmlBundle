<?php

  namespace DeBaasMedia\Bundle\XhtmlBundle;

  use Symfony\Component\HttpKernel\HttpKernelInterface
    , Symfony\Component\HttpKernel\Log\LoggerInterface
    , Symfony\Component\HttpKernel\Event\FilterResponseEvent
    , Symfony\Component\HttpFoundation\Request
    , Symfony\Component\HttpFoundation\Response;

  /**
   * ResponseListener
   *
   * @author Marijn Huizendveld <marijn.huizendveld@gmail.com>
   */
  class ResponseListener
  {

    /**
     * @var string
     */
    const MIME_TYPE = 'application/xhtml+xml';

    /**
     * @var string
     */
    protected $_charset;

    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * Instantiate a new listener.
     *
     * @param   string          $arg_charset
     * @param   LoggerInterface $arg_logger
     *
     * @return  void
     */
    public function __construct ($arg_charset, LoggerInterface $arg_logger = NULL)
    {
      $this->_charset = $arg_charset;
      $this->_logger  = $arg_logger;
    }

    /**
     * Listen to the core.
     *
     * @param   GetResponseEvent  $arg_event
     *
     * @return  void
     */
    public function onCoreResponse (FilterResponseEvent $arg_event)
    {
      if (HttpKernelInterface::MASTER_REQUEST === $arg_event->getRequestType())
      {
        $this->modifyMimeType($arg_event->getRequest(), $arg_event->getResponse());    
      }
    }

    /**
     * Modify the mime type if supported and applicable.
     *
     * @param   Request  $arg_request
     * @param   Response $arg_response
     *
     * @return  void
     */
    public function modifyMimeType (Request $arg_request, Response $arg_response)
    {
      if ('html' === $arg_request->getRequestFormat())
      {
        if (in_array(self::MIME_TYPE, $arg_request->getAcceptableContentTypes()))
        {
          $mimetype = sprintf('%s;%s', self::MIME_TYPE, $this->_charset);

          $arg_response->headers->set('Content-Type', $mimetype);

          if (NULL !== $this->_logger)
          {
            $this->_logger->debug(sprintf("Serving content with the %s mime type", $mimetype));
          }
        }
        elseif (NULL !== $this->_logger)
        {
          $this->_logger->debug(sprintf("Client does not accept the %s mime type", self::MIME_TYPE));
        }
      }
    }

  }