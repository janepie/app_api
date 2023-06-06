<?php

declare(strict_types=1);

/**
 *
 * Nextcloud - App Ecosystem V2
 *
 * @copyright Copyright (c) 2023 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @copyright Copyright (c) 2023 Alexander Piskun <bigcat88@icloud.com>
 *
 * @author 2023 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @license AGPL-3.0-or-later
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\AppEcosystemV2;

use OCP\IConfig;
use OCP\ISession;
use Sabre\DAV\Server;
use Sabre\DAV\ServerPlugin;
use Sabre\HTTP\RequestInterface;
use Sabre\HTTP\ResponseInterface;
use OCA\DAV\Connector\Sabre\Auth;

class DavPlugin extends ServerPlugin {
	/** @var ISession */
	private $session;

	/** @var IConfig */
	private $config;

	/** @var array */
	private $auth;

	/** @var Server */
	private $server;

	/** @var ExAppAuth */
	private $exAppAuth;

	public function __construct(ISession $session, IConfig $config, array $auth, ExAppAuth $exAppAuth) {
		$this->session = $session;
		$this->config = $config;
		$this->auth = $auth;
		$this->exAppAuth = $exAppAuth;
	}

	public function initialize(Server $server) {
		// before auth
		$server->on('beforeMethod:*', [$this, 'beforeMethod'], 9);
		$this->server = $server;
	}

	public function beforeMethod(RequestInterface $request, ResponseInterface $response) {
		// TODO
	}
}
