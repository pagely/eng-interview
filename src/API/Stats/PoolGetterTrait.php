<?php
namespace Pagely\Interview\API\Stats;

use GuzzleHttp\Exception\ClientException;
use Pagely\ApiFramework\Authorization\AuthorizationException;
use Pagely\ApiFramework\Action\NotFoundException;
use Pagely\ApiFramework\Contract\ActionInputInterface;
use Pagely\ApiFramework\InputDefinition\AccountPermissionInputInterface;
use Pagely\ApiFramework\InputDefinition\AuthInputInterface;
use Pagely\ApiFramework\Middleware\InvalidInputDefinitionException;
use Pagely\Client\AccountsApi\AccountsApi;
use Pagely\Model\Accounts\Account;

/**
 * @property AccountsApi $accountsApi
 */
trait PoolGetterTrait
{
    protected function poolFromAccount(ActionInputInterface $input, array $fourOFourPools = ["", "20"]): string
    {
        if (!($input instanceof AuthInputInterface) || !($input instanceof AccountPermissionInputInterface)) {
            throw new InvalidInputDefinitionException(get_class($input));
        }
        try {
            /** @var Account $account */
            $account = $this->hydrator->hydrateFromResponse(
                $this->accountsApi->getAccount($input->getBearerToken(), $input->getAccountId())
            );
            $pool = $account->getDefPoolId();
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new NotFoundException();
            }
            if ($e->getResponse()->getStatusCode() === 403) {
                throw new AuthorizationException();
            }
            throw $e;
        }

        if (in_array((string) $pool, $fourOFourPools, true)) {
            throw new NotFoundException();
        }
        return $pool;
    }
}
