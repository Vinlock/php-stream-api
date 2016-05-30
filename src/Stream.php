<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 5:50 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI;


use Vinlock\StreamAPI\Exceptions\ProtectedValue;

/**
 * Class Stream
 * @package Vinlock\StreamAPI
 */
abstract class Stream {

    /**
     * Stream Info Array from JSON
     *
     * @var array
     */
    protected $stream;

    protected $service;

    /**
     * Append Stream Service to ID
     *
     * @var bool
     */
    protected $append_id = TRUE;

    /**
     * Guarded Members
     *
     * @var array
     */
    private $guarded = [
        "username", "displayName", "preview", "status", "url", "viewers", "id", "avatar"
    ];

    public $customMembers = [];

    /**
     * Key to what will be returned if object is treated as a string.
     * May be overidden.
     *
     * @var string
     */
    protected $string = "displayName";

    public function members() {
        return [
            "username" => $this->username(),
            "displayName" => $this->displayName(),
            "game" => $this->game(),
            "preview" => [
                "small" => $this->smallPreview(),
                "medium" => $this->mediumPreview(),
                "large" => $this->largePreview()
            ],
            "status" => $this->status(),
            "url" => $this->url(),
            "viewers" => $this->viewers(),
            "id" => $this->streamID(),
            "avatar" => $this->avatar()
        ];
    }

    /**
     * String Method
     *
     * @return string
     */
    public final function __toString() {
        return $this->members()[$this->string];
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws ProtectedValue
     */
    public final function __set(string $name, $value) {
        if (in_array($name, $this->guarded)) {
            throw new ProtectedValue($name);
        } else {
            $this->customMembers[$name] = $value;
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public final function __get(string $name) {
        if (array_key_exists($name, $this->members())) {
            return $this->members()[$name];
        } elseif (array_key_exists($name, $this->customMembers)) {
            return $this->customMembers[$name];
        } else {
            return NULL;
        }
    }

    /**
     * Stream Preview
     *
     * @param string $size small|medium|large
     * @return string
     */
    public function preview($size = "large") {
        switch ($size) {
            case "small":
                return $this->smallPreview();
            case "medium":
                return $this->mediumPreview();
            case "large":
                return $this->largePreview();
            default:
                return $this->largePreview();
        }
    }

    private function streamID() {
        return ($this->append_id) ? $this->id().$this->service : $this->id();
    }

    /**
     * Stream Username
     *
     * @return string
     */
    abstract public function username();

    /**
     * Stream Display Name
     *
     * @return string
     */
    abstract public function displayName();

    /**
     * Stream Game
     *
     * @return string
     */
    abstract public function game();

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    abstract public function largePreview();

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    abstract public function mediumPreview();

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    abstract public function smallPreview();

    /**
     * Stream Status
     *
     * @return string
     */
    abstract public function status();

    /**
     * Stream URL
     *
     * @return string
     */
    abstract public function url();

    /**
     * Stream Viewers
     *
     * @return integer
     */
    abstract public function viewers();

    /**
     * Stream ID
     *
     * @return string
     */
    abstract public function id();

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    abstract public function avatar();



}