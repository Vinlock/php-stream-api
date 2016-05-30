<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 7:16 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\StreamObjects;


use Vinlock\StreamAPI\StreamInterface;

class Hitbox extends Stream implements StreamInterface {

    protected $service = 'hitbox';

    const STREAM_KEY = "livestream";

    const STREAM_API = "https://www.hitbox.tv/api/media/live/";

    const GAMES_API = "https://api.hitbox.tv/media/live/list?game=";

    const STREAM_IMG = "http://edge.sf.hitbox.tv";

    const STREAM_URL = "http://www.hitbox.tv/";

    public function __construct($array) {
        $this->stream = $array;
    }

    /**
     * Stream Username
     *
     * @return string
     */
    public function username() {
        return $this->stream['media_user_name'];
    }

    /**
     * Stream Display Name
     *
     * @return string
     */
    public function display_name() {
        return $this->stream['media_user_name'];
    }

    /**
     * Stream Game
     *
     * @return string
     */
    public function game() {
        return $this->stream['category_name'];
    }

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    public function largePreview() {
        return self::STREAM_IMG.stripslashes($this->stream['media_thumbnail_large']);
    }

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    public function mediumPreview() {
        return self::STREAM_IMG.stripslashes($this->stream['media_thumbnail_large']);
    }

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    public function smallPreview() {
        return self::STREAM_IMG.stripslashes($this->stream['media_thumbnail']);
    }

    /**
     * Stream Status
     *
     * @return string
     */
    public function status() {
        $status = $this->stream['media_status'];
        $status = htmlspecialchars($status);
        $status = html_entity_decode($status, ENT_QUOTES);
        $status = preg_replace("/\r|\n/", "", $status);
        return $status;
    }

    /**
     * Stream URL
     *
     * @return string
     */
    public function url() {
        return stripslashes($this->stream['channel']['channel_link']);
    }

    /**
     * Stream Viewers
     *
     * @return integer
     */
    public function viewers() {
        return $this->stream['media_views'];
    }

    /**
     * Stream ID
     *
     * @return string
     */
    public function id() {
        return $this->stream['media_id'];
    }

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    public function avatar() {
        return self::STREAM_IMG.stripcslashes($this->stream['channel']['user_logo']);
    }

}