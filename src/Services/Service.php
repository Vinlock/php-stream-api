<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 8:19 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\StreamDriver;
use Vinlock\StreamAPI\StreamObjects\Stream;

/**
 * Class Service
 * @package Vinlock\StreamAPI\Services
 */
class Service {

    /**
     *
     *
     * @var array
     */
    protected $streams;

    /**
     * Current Service
     *
     * @var null
     */
    protected static $service = NULL;

    /**
     * Service constructor.
     * @param array $streams
     */
    public function __construct(array $streams) {
        $this->streams = $streams;
    }

    /**
     * Universal Constructor for Child Stream Services
     *
     * @param $array
     * @return array
     */
    protected function service_construct($array) {
        $usernames = [];
        foreach ($array as $param) {
            if (is_array($param)) {
                $usernames = $param;
            } elseif (is_string($param)) {
                array_push($usernames, $param);
            }
        }
        return StreamDriver::getStreams($usernames, static::$service);
    }

    /**
     * Find a stream where key = value.
     * Defaults key to username.
     *
     * @param $value
     * @param string $key
     * @return mixed
     */
    public function where($value, $key='username') {
        foreach ($this->streams as &$arr) {
            if ($arr->$key == $value) {
                $item =& $arr;
                return $item;
            }
        }
    }

    /**
     * Give ALL streams a key=value pair.
     * You can only set a key once. After it may not be modified.
     *
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value) {
        foreach ($this->streams as $stream) {
            $stream->$name = $value;
        }
    }

    /**
     * Get the streams as an array of /StreamObjects/Stream
     *
     * @return array
     */
    public function get() {
        return $this->streams;
    }

    /**
     * Get the streams as an array.
     *
     * @return array
     */
    public function getArray() {
        $streams = [];

        /** @var \Vinlock\StreamAPI\StreamObjects\Stream $stream */
        foreach ($this->streams as $stream) {
            array_push($streams, $stream->get());
        }

        return $streams;
    }

    /**
     * Get the streams as JSON.
     *
     * @param bool $pretty
     * @return string
     */
    public function getJSON(bool $pretty=FALSE) {
        return json_encode($this->getArray(), ($pretty) ? JSON_PRETTY_PRINT : NULL);
    }

    /**
     * Get the streams as an object.
     *
     * @return object
     */
    public function getObject() {
        return (object) $this->getArray();
    }

    /**
     * Sort all streams by viewers.
     * Highest to Lowest.
     *
     * @param null $sort
     */
    public function sort($sort=NULL) {
        $sort = ($sort == NULL) ? $this->streams : $sort;
        usort($sort, function($a, $b) {
            return $b->viewers() <=> $a->viewers();
        });
    }

    public function merge(Service $merge) {
        $new_array = [];
        /** @var Stream $merge_stream */
        foreach ($merge->get() as $merge_stream) {
            $found = FALSE;
            /** @var Stream $stream */
            foreach ($this->streams as $key => $stream) {
                if ($stream->username === $merge_stream->username && $stream->service === $merge_stream->service) {
                    if ($merge_stream->hasCustomKeys()) {
                        $this->streams[$key] = $merge_stream;
                    }
                    $found = TRUE;
                }
            }
            if (!$found) {
                array_push($this->streams, $merge_stream);
            }
        }
        return $this;
    }

    /**
     * Merge two Service Objects together.
     *
     * @param null $arr
     * @return Service
     */
    public static function mergeMulti($arr = NULL) {
        if (!is_array($arr)) {
            $arr = func_get_args();
        }
        $first = NULL;
        /** @var Service $param */
        foreach ($arr as $param) {
            if (is_null($first)) {
                $first = $param;
            }
            $first->merge($param);
        }
        $first->sort();
        return $first;
    }

    /**
     * Get streams of a game.
     *
     * @return Service
     */
    public static function game() {
        $all_streams = [];
        foreach (func_get_args() as $param) {
            if (is_array($param)) {
                foreach ($param as $game) {
                    $all_streams = array_merge($all_streams, StreamDriver::byGame($game, static::$service));
                }
            } elseif (is_string($param)) {
                $all_streams = array_merge($all_streams, StreamDriver::byGame($param, static::$service));
            }
        }
        $streams = new Service($all_streams);
        $streams->sort();
        return $streams;
    }

    public function removeDuplicates() {
        $marker = substr(str_shuffle(MD5(microtime())), 0, 10);
        $new_array = [];
        /** @var Stream $stream */
        foreach ($this->streams as $stream) {
            /** @var Stream $check */
            foreach ($this->stream as $check) {
                $found = FALSE;
                if ($stream->username === $check->username && $stream->service === $check->service) {
                    if ($found) {
                        $check->$marker = TRUE;
                        continue;
                    }
                    if (!isset($check->$marker)) {
                        if ($stream->hasCustomKeys()) {
                            array_push($new_array, $stream);
                        } else {
                            array_push($new_array, $check);
                        }
                        $stream->$marker = TRUE;
                        $check->$marker = TRUE;
                        $found = TRUE;
                    } else {
                        break;
                    }
                }
            }
        }
        $this->streams = $new_array;
    }

    /**
     * Truncate the streams.
     *
     * @param int $num 10
     * @param bool $remove_duplicates
     */
    public function cut(int $num=10, $remove_duplicates = FALSE) {
        if ($remove_duplicates) {
            $this->removeDuplicates();
        }
        $this->streams = array_slice($this->streams, 0, $num);
    }

    /**
     * Prepend Service object to this object.
     *
     * @param Service $service
     */
    public function prepend(Service $service) {
        $this->streams = array_push($service->get(), $this->streams);
    }

    public function attach(Service $service) {
        $this->streams = array_push($this->streams, $service->get());
    }

}
