<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 7:13 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Vinlock\StreamAPI;


abstract class StreamDriver {

    /**
     * Max Number per multi stream request.
     *
     * // Twitch's Max for Multi Streams is 100
     */
    const NUM_PER_MULTI = 100;

    /**
     * Class providers for each stream service.
     *
     * @var array
     */
    private static $providers = [
        "twitch" => Twitch\StreamObject::class,
        "hitbox" => Hitbox\StreamObject::class
    ];

    /**
     * Retrieve a single stream.
     *
     * @param string $username
     * @param string $service
     * @return mixed
     */
    final public static function SingleStream(string $username, string $service) {
        var_dump($username);
        exit();
        $json = json_decode(\Requests::get(self::$providers[$service]::STREAM_API . $username), TRUE);
        $streamObject = new self::$providers[$service]($json[self::$providers[$service]::STREAM_KEY][0]);
        return $streamObject;
    }

    /**
     * Retrieve an array of streams.
     *
     * @param array $stream_usernames
     * @param string $service
     * @return array
     */
    final public static function MultiStream(array $stream_usernames, string $service) {
        $streams = array();

        $chunks = array_chunk($stream_usernames, self::NUM_PER_MULTI);

        foreach ($chunks as $chunk) {
            $list = implode(",", $chunk);
            $json = json_decode(\Requests::get(self::$providers[$service]::STREAM_API.$list), TRUE);
            foreach ($json[self::$providers[$service]::STREAM_KEY] as $stream) {
                $streamObject = new self::$providers[$service]($stream);
                array_push($streams, $streamObject);
            }
        }
        return $streams;
    }

    /**
     * Get the JSON data with CURL
     *
     * @param $url
     * @return mixed
     */
    final private static function curl_get_contents($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}