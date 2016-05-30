<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 7:16 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI\Hitbox;


use Vinlock\StreamAPI\Stream;
use Vinlock\StreamAPI\StreamInterface;

class StreamObject extends Stream implements StreamInterface {

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
        return $this->stream['channel']['name'];
    }

    /**
     * Stream Display Name
     *
     * @return string
     */
    public function displayName() {
        return $this->stream['channel']['display_name'];
    }

    /**
     * Stream Game
     *
     * @return string
     */
    public function game() {
        return $this->stream['game'];
    }

    /**
     * URL to Large Stream Preview
     *
     * @return string
     */
    public function largePreview() {
        return $this->stream['preview']['large'];
    }

    /**
     * URL to Medium Stream Preview
     *
     * @return string
     */
    public function mediumPreview() {
        return $this->stream['preview']['medium'];
    }

    /**
     * URL to Small Stream Preview
     *
     * @return string
     */
    public function smallPreview() {
        return $this->stream['preview']['small'];
    }

    /**
     * Stream Status
     *
     * @return string
     */
    public function status() {
        return $this->stream['channel']['status'];
    }

    /**
     * Stream URL
     *
     * @return string
     */
    public function url() {
        return $this->stream['channel']['url'];
    }

    /**
     * Stream Viewers
     *
     * @return integer
     */
    public function viewers() {
        return $this->stream['viewers'];
    }

    /**
     * Stream ID
     *
     * @return string
     */
    public function id() {
        return $this->stream['_id'];
    }

    /**
     * Stream Avatar URL
     *
     * @return string
     */
    public function avatar() {
        return $this->stream['channel']['logo'];
    }

}