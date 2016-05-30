<?php
/**
 * Website: vinlock-twitch-api
 * Created By: Vinlock
 * Date: 5/29/16 9:52 PM
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

require_once ("../vendor/autoload.php");
//
//$twitch = new \Vinlock\StreamAPI\Services\Twitch(['trick2g', 'mufflermankr', 'sirhcez', 'opsct', 'gamesager', 'praetor19', 'nl_Kripp']);
//$twitch->where("trick2g")->hi = "hello";
//
//$hitbox = new \Vinlock\StreamAPI\Services\Hitbox(['tophatsandchampagne']);
//
//$merge = \Vinlock\StreamAPI\Services\Service::merge($twitch, $hitbox);
//
//header('Content-Type: application/json');
//
//echo $merge->getJSON();

$twitch = \Vinlock\StreamAPI\Services\Twitch::game("Dota 2");

$hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Dota 2");

$merge = \Vinlock\StreamAPI\Services\Service::merge($twitch, $hitbox);

header('Content-Type: application/json');

echo $merge->getJSON();

//echo $streams->getJSON();