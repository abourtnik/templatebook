<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Facture n° <?php echo $this->fetch('title'); ?> </title>

    <?php echo $this->Html->meta('facture.ico','/facture.ico', array('type' => 'icon')); ?>

    <?php echo $this->Html->css(array(
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css',
        'https://fonts.googleapis.com/css?family=Roboto',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        'facture'
    )); ?>
    <?php echo $this->fetch('css'); ?>

</head>

<body>

<div class="container">

    <?php echo $this->fetch('content'); ?>

</div>

<footer class="text-center">
    <p class="text-muted">TemplateBook</p>
    <p class="text-muted">La facture a été créée sur un ordinateur elle est donc valable sans la signature et le sceau de l'entreprise.</p>
</footer>

</body>
</html>