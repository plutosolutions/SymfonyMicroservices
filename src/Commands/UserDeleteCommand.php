<?php
/**
 * Class/file UserDeleteCommand.php
 *
 * @author John Pluto Solutions <john@pluto.solutions>
 * Date: 2/16/2019
 * Time: 11:58 AM
 */

namespace App\Commands;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class UserDeleteCommand extends Command
{
    public function configure()
    {
        $this->setName('user-delete')
            ->setDescription('Delete user. See follow Help.')
            ->setHelp('php bin/console user-delete');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserId = new Question('Please enter used id : ', '');

        if ($userId = $helper->ask($input, $output, $questionUserId)) {
            $userManager = new UserManager();
            $user = $userManager->delete($userId);

            $output->writeln('');
            $output->writeln(sprintf('/****************/'));
            $output->writeln(sprintf('Deleted user id : '.$userId));
            $output->writeln('');
        } else {
            $output->writeln("Please try again, thanks !");
        }
    }
}