<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Core\Contracts\TransformerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @var
     */
    protected $statusCode = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var null
     */
    protected $_transformer;

    /**
     * @var
     */
    protected $_fractal;

    /**
     * @var array
     */
    protected $javascript = [];

    /**
     * @var array
     */
    protected $pageAttributes = [];

    /**
     * Adds javascript compoennts to the front-end view attributes
     *
     * @param string $script
     */
    public function addScript($script)
    {
        if (is_array($script)) {
            $this->pageAttributes['scripts'] = array_merge($this->pageAttributes['scripts'], $script);
        } else {
            $this->pageAttributes['scripts'][] = $script;
        }

        return $this;
    }

    /**
     * Sets the page title for the sub menu on the front-end
     *
     * @param  string $title
     */
    public function setPageTitle($title)
    {
        $this->pageAttributes['page_title'] = $title;

        return $this;
    }

    /**
     * Combines view attributes
     *
     * @param  array  $data
     * @return array
     */
    public function parseViewData(array $data = [])
    {
        return array_merge($data, $this->pageAttributes);
    }

    /**
     * Loads view with scripts
     *
     * @param  string $view - The name of the view to load
     * @param  array  $data
     * @return view
     */
    public function loadViewWithScripts($view, $data = [])
    {
        $viewData = $this->parseViewData($data);

        return view($view, $viewData);
    }

    /**
     * @param TransformerInterface $transformer
     */
    public function setTransformer(TransformerInterface $transformer)
    {
        $this->_fractal = new Manager();

        $this->_transformer = $transformer;
    }

    /**
     * Transform a collection of items
     *
     * @param $data
     * @return mixed
     */
    public function transformCollection($data)
    {
        $resource = new Collection($data, $this->_transformer);

        return $this->_fractal->createData($resource)->toArray();
    }

    /**
     * Transform a single item
     *
     * @param  array $data
     * @return array
     */
    public function transformItem($data)
    {
        $resource = new Item($data, $this->_transformer);

        return $this->_fractal->createData($resource)->toArray();
    }

    /**
     * Transforms a data set by whether it's an array ornot
     *
     * @param  mixed $data
     * @return array
     */
    public function transform($data)
    {
        if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
            return $this->transformCollection($data);
        }
        return $this->transformItem($data);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $keypairs
     * @return $this
     */
    public function setHeaders(array $keypairs)
    {
        $this->headers = array_merge($this->headers, $keypairs);

        return $this;
    }

    /**
     * @param $data
     * @param null $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, $statusCode = null, $headers = [])
    {
        if ($statusCode) {
            $this->setStatusCode($statusCode);
        }

        if ($headers) {
            $this->setHeaders($headers);
        }

        $data = is_array($data) ? $data : ['reason_phrase' => $data];
        $data = array_merge($data, ['status_code' => $this->getStatusCode()]);

        $response = new JsonResponse($data, $this->getStatusCode(), $this->getHeaders());

        return $response;
    }

    /**
     * @param null $createdData
     * @param null $reason
     * @return JsonResponse
     */
    public function respondCreated($createdData = null, $reason = null)
    {
        $data = [
            'reason_phrase' => 'Resource created',
            'status_code' => 201,
        ];

        if ($createdData) {
            $data = array_merge($data, $createdData);
        }

        if ($reason) {
            $data = array_merge($data, ['reason_phrase' => $reason]);
        }
        return $this->respond($data, 201);
    }

    /**
     * @param $url
     * @param array $modal
     * @param array $callback
     * @return JsonResponse
     */
    public function respondRedirect($url, array $modal = [], array $callback = [])
    {
        $data = [
            'redirect_url' => $url,
            'status_code' => 303
        ];
        if (count($modal)) {
            $data = array_merge($data, ['modal' => $modal]);
        }

        if(count($callback)) {
            $data['callback'] = $callback;
        }

        return $this->respond($data, 303);
    }

    /**
     * @param string $msg
     * @return JsonResponse
     */
    public function respondUpdated($msg = "Resource successfully updated", $createdData = null)
    {
        $data = [
            'status_code' => 200,
            'reason_phrase' => $msg
        ];

        if ($createdData) {
            $data = array_merge($data, $createdData);
        }
        return $this->respond($data, 200);
    }

    /**
     * Successful API call but no content found
     *
     * @param  string $msg
     * @return JsonResponse
     */
    public function respondNoContent($msg = 'No Content')
    {
        $data = [
            'status_code' => 204,
            'reason_phrase' => $msg
        ];
        return $this->respond($data, 204);
    }

    /**
     * Unlike no content this requires that
     * the client side form be updated.
     * Chiefly in use for investment manage page
     *
     * @param string $msg
     * @return JsonResponse
     */
    public function respondResetContent($msg = 'Reset Content')
    {
        $data = [
            'status_code' => 205,
            'reason_phrase' => $msg
        ];
        return $this->respond($data, 205);
    }

    /**
     * @param int $statusCode
     * @param null $reason
     * @param null $errors
     * @param null $headers
     * @param array $responseData
     * @return JsonResponse
     */
    public function respondWithError($statusCode=500, $reason=null, $errors = null, $headers=null, $responseData=[])
    {
        if ($statusCode > 200 && $statusCode < 300) {
            // throw new LogicException('Incorrect status code used for error: '.$statusCode);
        }

        if ($statusCode) {
            $this->setStatusCode($statusCode);
        }

        if ($headers) {
            $this->setHeaders($headers);
        }

        $data = [
            'status_code' => $this->getStatusCode(),
        ];

        if ($reason) {
            $data = array_merge($data, ['reason_phrase' => $reason]);
        }

        if ($errors) {
            $data = array_merge($data, ['errors' => $errors]);
        }

        if ($data) {
            $data = array_merge($data, $responseData);
        }

        $response = new JsonResponse($data, $this->getStatusCode(), $this->getHeaders());

        return $response;
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondBadRequest($reason = null, $errors = null, $data=[])
    {
        return $this->respondWithError(400, $reason, $errors, null, $data);
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondUnauthorized($reason = null, $errors = null)
    {
        return $this->respondWithError(401, $reason, $errors);
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondForbidden($reason = null, $errors = null)
    {
        return $this->respondWithError(403, $reason, $errors);
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondNotFound($reason = null, $errors = null)
    {
        return $this->respondWithError(404, $reason, $errors);
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondUnprocessed($reason = null, $errors = null)
    {
        return $this->respondWithError(422, $reason, $errors);
    }

    /**
     * @param null $reason
     * @param null $errors
     * @return JsonResponse
     */
    public function respondInternalError($reason = null, $errors = null)
    {
        return $this->respondWithError(500, $reason, $errors);
    }

    /**
     * @param null $reason
     * @return JsonResponse
     */
    public function respondUnavailable($reason = null)
    {
        $reason = $reason ?: MAINTENANCE_MODE;

        return $this->respondWithError(503, $reason);
    }
}
