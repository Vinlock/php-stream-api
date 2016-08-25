<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 8:19 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\Exceptions\APIError;
use Vinlock\StreamAPI\StreamDriver;

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
     */
    public function __construct() {
        $streams = self::convertArgs(func_get_args());
        foreach ($streams as $stream) {
            if ($stream instanceof Service) {
                $this->streams = $stream->get();
            } elseif (is_array($streams)) {
                $this->streams = StreamDriver::getStreams($streams, static::$service);
            }
        }
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
     * @throws APIError
     */
    public function where($value, $key='username') {
        foreach ($this->streams as &$arr) {
            if ($arr->$key == $value) {
                $item =& $arr;
                return $item;
            }
        }
        return new \stdClass();
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
            $streams[] = $stream->get();
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
     * Sort all streams by default viewers.
     * May set $byKey to which key to sort by.
     * Highest to Lowest or set direction.
     *
     * @param null $sort
     * @param string $byKey
     * @param string $direction
     */
    public function sort($sort=NULL, $byKey="viewers", $direction="desc") {
        $sort = ($sort == NULL) ? $this->streams : $sort;
        usort($sort, function($a, $b) use ($direction, $byKey) {
            if ($direction == "desc") return $b->$byKey() <=> $a->$byKey();
            elseif ($direction == "asc") return $a->$byKey() <=> $b->$byKey();
        });
    }

    /**
     * Merge one or more services publicly.
     *
     * @return $this
     */
    public function merge() {
        // Allow for unlimited arguments or an array.
        $args = self::convertArgs(func_get_args());
        foreach ($args as $arg) {
            // Commit the merge
            $this->streams = array_merge($this->streams, $arg->get());
            // Remove any duplicates.
            $this->removeDuplicates();
        }
        return $this;
    }

    /**
     * Get streams of a game.
     *
     * @return Service
     */
    public static function game() {
        // Allow for unlimited arguments or an array.
        $games = self::convertArgs(func_get_args());
        $gameObjects = [];
        foreach ($games as $game) {
            // Build an array of the stream objects.
            $gameObjects = array_merge($gameObjects, StreamDriver::byGame($game, static::$service));
        }
        // Store the streams in a new Service.
        $streams = new Service($gameObjects);
        // Sort by viewers.
        $streams->sort();
        return $streams;
    }

    /**
     * Removes duplicate streams.
     *
     * @param bool $sort
     * @return $this
     */
    public function removeDuplicates($sort = TRUE) {
        $this->streams = array_unique($this->streams, SORT_STRING);
        if ($sort) $this->sort();
        return $this;
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

    private static function convertArgs($args) {
        return is_array($args[0]) ? $args[0] : $args;
    }

    /**
     * Prepend Service object to this object.
     *
     * @param Service $service
     */
    public function prepend(Service $service) {
        array_merge($service->get(), $this->streams);
    }

    public function attach(Service $service) {
        array_merge($this->streams, $service->get());
    }

}