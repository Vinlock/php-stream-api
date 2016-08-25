<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 7:13 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI;


use Vinlock\StreamAPI\StreamObjects\HitboxObject;
use Vinlock\StreamAPI\StreamObjects\TwitchObject;

abstract class StreamDriver {

    /**
     * Max Number per multi stream request.
     *
     * // Twitch's Max for Multi Streams is 100
     */
    const NUM_PER_MULTI = 100;

    protected static $limit = NULL;

    /**
     * Class providers for each stream service.
     *
     * @var array
     */
    public static $providers = [
        "twitch" => TwitchObject::class,
        "hitbox" => HitboxObject::class
    ];

    /**
     * Retrieve an array of streams.
     *
     * @param array $stream_usernames
     * @param string $service
     * @return array
     */
    public static function getStreams(array $stream_usernames, string $service) {
        $streams = array();

        $chunks = array_chunk($stream_usernames, self::NUM_PER_MULTI);

        foreach ($chunks as $chunk) {
            $list = implode(',', $chunk);
            $json = json_decode(\Requests::get(self::$providers[$service]::STREAM_API.$list)->body, TRUE);
            $found_streams = $json[self::$providers[$service]::STREAM_KEY];
            foreach ($found_streams as $stream) {
                $streams[] = new self::$providers[$service]($stream);
            }
        }
        return $streams;
    }

    public static function byGame(string $game, string $service, $limit = NULL) {
        $limit = is_null($limit) ? is_null(self::$limit) ? self::NUM_PER_MULTI : self::$limit : $limit;
        $streams = array();

        $stream_key = self::$providers[$service]::STREAM_KEY;
        $apiURL =self::$providers[$service]::GAMES_API;
        $game = urlencode($game);
        $json = json_decode(\Requests::get("{$apiURL}{$game}&limit={$limit}")->body, TRUE);
        if (!empty($json[$stream_key])) {
            foreach ($json[$stream_key] as $stream) {
                $streams[] = new self::$providers[$service]($stream);
            }
        }
        return $streams;
    }

    public static function setLimit(int $limit) {
        self::$limit = $limit;
    }

}
