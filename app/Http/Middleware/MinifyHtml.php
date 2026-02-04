<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($this->isHtmlResponse($response)) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;
    }

    /**
     * Check if the response is HTML.
     *
     * @param  mixed  $response
     * @return bool
     */
    protected function isHtmlResponse($response)
    {
        $contentType = $response->headers->get('Content-Type');
        return is_string($contentType) && strpos($contentType, 'text/html') !== false;
    }

    /**
     * Minify the HTML content.
     *
     * @param  string  $html
     * @return string
     */
    protected function minify($html)
    {
        $search = [
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        ];

        $replace = [
            '>',
            '<',
            '\\1',
            ''
        ];

        return preg_replace($search, $replace, $html);
    }
}
