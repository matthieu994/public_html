<div grid>
	<div column="+3 5">
		<?php echo validation_errors(); ?>
		<?php echo form_open('contacts/create',array()); ?>
		<fieldset>
			<legend>Ajouter un contact</legend>

			<!-- Text input-->
			<div>
				<label  for="nom">Nom</label>
				<input value="<?=set_value('nom')?>" id="nom" name="nom" placeholder="Nom"  required type="text">
			</div>

			<!-- Text input-->
			<div >
				<label  for="prenom">Prénom</label>
				<input value="<?=set_value('prenom')?>" id="prenom" name="prenom" placeholder="Prénom"  required type="text">
			</div>

			<!-- Email input-->
			<div >
				<label  for="email">Email</label>
				<input value="<?=set_value('email')?>" id="email" name="email" placeholder="Adresse Mail" required type="email">
			</div>

			<!-- Button -->
			<div class="_mts">
				<button id="envoyer" name="envoyer">Créer</button>
			</div>

		</fieldset>
	</form>
</div>
</div>
