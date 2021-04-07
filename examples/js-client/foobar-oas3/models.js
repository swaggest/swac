// Code is generated by github.com/swaggest/swac <version>, do not edit. 🤖

/**
 * @typedef DeletePlacesRequest
 * @type {object}
 * @property {number} id.
 */

/**
 * @callback cbEmpty
 */

/**
 * @typedef RestErrResponse
 * @type {object}
 * @property {number} code.
 * @property {object<string, *>} context.
 * @property {string} error.
 * @property {string} status.
 */

/**
 * @callback cbRestErrResponse
 * @param {RestErrResponse} value
 */

/**
 * @typedef GetPlacesRequest
 * @type {object}
 * @property {string} mille - Acme Mille.
 * @property {string} foxUuid.
 * @property {number} foxId.
 * @property {string} look - Acme Look.
 * @property {string} potatoFamily.
 */

/**
 * @typedef PlaceEntity
 * @type {object}
 * @property {number} placeId.
 * @property {string} createdAt.
 * @property {number} foxId.
 * @property {string} foxUuid.
 * @property {number} fooId.
 * @property {string} barName.
 */

/**
 * @callback cbPlaceEntity
 * @param {PlaceEntity} value
 */

/**
 * @typedef UsecaseCreatePlaceInput
 * @type {object}
 * @property {number} foxId.
 * @property {string} foxUuid.
 * @property {number} fooId.
 * @property {string} barName.
 */

/**
 * @typedef PostPlacesRequest
 * @type {object}
 * @property {UsecaseCreatePlaceInput} body.
 */

/**
 * @typedef DeleteFoosRequest
 * @type {object}
 * @property {number} id.
 */

/**
 * @typedef GetFoosRequest
 * @type {object}
 * @property {string} look - Acme Look.
 * @property {string} potatoFamily.
 * @property {string} mille - Acme Mille.
 */

/**
 * @typedef FooLocalActivation
 * @type {object}
 * @property {number} maxRoxesReceived.
 * @property {number} minRoxesReceived.
 */

/**
 * @typedef LiesPreference
 * @type {object}
 * @property {array<number>} other.
 * @property {string} preset.
 * @property {array<number>} recommended.
 */

/**
 * @typedef LiesModularityAddOns
 * @type {object}
 * @property {number} index.
 * @property {string} title.
 */

/**
 * @typedef LiesModularityBar
 * @type {object}
 * @property {number} index.
 * @property {string} title.
 */

/**
 * @typedef LiesModularity
 * @type {object}
 * @property {array<LiesModularityAddOns>} addOns.
 * @property {string} addOnsHeadline.
 * @property {number} defaultCarrotIndex.
 * @property {string} noAddOnsDefaultTitle.
 * @property {string} noBarsDefaultTitle.
 * @property {string} promoTitle.
 * @property {array<LiesModularityBar>} bars.
 * @property {string} barsHeadline.
 */

/**
 * @typedef FooBarRule
 * @type {object}
 * @property {array<LiesPreference>} customLiePreferences.
 * @property {array<LiesModularity>} customModularity.
 * @property {object<string, string>} customSoups.
 * @property {array<number>} hideCarrots.
 * @property {object<string, array<string>>} areaTagsByCarrots.
 */

/**
 * @typedef FooEntity
 * @type {object}
 * @property {string} activateSince.
 * @property {string} activateTill.
 * @property {string} mille - Acme Mille.
 * @property {string} createdAt.
 * @property {string} deletedAt.
 * @property {number} fooId.
 * @property {object<string, FooLocalActivation>} localActivation.
 * @property {string} uselyKey.
 * @property {array<FooEntity>} overlap.
 * @property {string} potatoFamily.
 * @property {string} updatedAt.
 * @property {object<string, FooBarRule>} barRules.
 * @property {string} lookEnd - Acme Look.
 * @property {string} lookStart - Acme Look.
 */

/**
 * @typedef UsecaseFooInfo
 * @type {object}
 * @property {string} activateSince.
 * @property {string} activateTill.
 * @property {boolean} availableForActivation.
 * @property {string} mille - Acme Mille.
 * @property {string} createdAt.
 * @property {string} deletedAt.
 * @property {number} fooId.
 * @property {object<string, FooLocalActivation>} localActivation.
 * @property {string} uselyKey.
 * @property {array<FooEntity>} overlap.
 * @property {string} potatoFamily.
 * @property {string} updatedAt.
 * @property {object<string, FooBarRule>} barRules.
 * @property {string} lookEnd - Acme Look.
 * @property {string} lookStart - Acme Look.
 */

/**
 * @callback cbArrayUsecaseFooInfo
 * @param {array<UsecaseFooInfo>} value
 */

/**
 * @typedef FooValue
 * @type {object}
 * @property {string} activateSince.
 * @property {string} activateTill.
 * @property {string} mille - Acme Mille.
 * @property {object<string, FooLocalActivation>} localActivation.
 * @property {string} uselyKey.
 * @property {string} potatoFamily.
 * @property {object<string, FooBarRule>} barRules.
 * @property {string} lookEnd - Acme Look.
 * @property {string} lookStart - Acme Look.
 */

/**
 * @typedef PostFoosRequest
 * @type {object}
 * @property {FooValue} body.
 */

/**
 * @callback cbFooEntity
 * @param {FooEntity} value
 */

/**
 * @typedef UsecaseUpdateFooInput
 * @type {object}
 * @property {string} activateSince.
 * @property {string} activateTill.
 * @property {string} mille - Acme Mille.
 * @property {object<string, FooLocalActivation>} localActivation.
 * @property {string} uselyKey.
 * @property {string} potatoFamily.
 * @property {object<string, FooBarRule>} barRules.
 * @property {string} lookEnd - Acme Look.
 * @property {string} lookStart - Acme Look.
 */

/**
 * @typedef PutFoosRequest
 * @type {object}
 * @property {number} id.
 * @property {UsecaseUpdateFooInput} body.
 */

/**
 * @typedef UsecaseFindAvailableCarrotsInputItem
 * @type {object}
 * @property {number} foxId.
 * @property {string} foxUuid.
 * @property {string} potatoFamily.
 * @property {number} holeId.
 */

/**
 * @typedef UsecaseFindAvailableCarrotsInput
 * @type {object}
 * @property {object<string, UsecaseFindAvailableCarrotsInputItem>} items.
 */

/**
 * @typedef PostInternalFindAvailableCarrotsMilleLookRequest
 * @type {object}
 * @property {string} mille - Acme Mille.
 * @property {string} look - Acme Look.
 * @property {UsecaseFindAvailableCarrotsInput} body.
 */

/**
 * @typedef UsecaseFindAvailableCarrotsOutputItem
 * @type {object}
 * @property {array<number>} carrots.
 * @property {string} error.
 */

/**
 * @typedef UsecaseFindAvailableCarrotsOutput
 * @type {object}
 * @property {object<string, UsecaseFindAvailableCarrotsOutputItem>} items - Available carrot indexes mapped with same key as input items.
 */

/**
 * @callback cbUsecaseFindAvailableCarrotsOutput
 * @param {UsecaseFindAvailableCarrotsOutput} value
 */

/**
 * @typedef GetLieAreasRequest
 * @type {object}
 * @property {string} mille - Acme Mille.
 */

/**
 * @callback cbArrayString
 * @param {array<string>} value
 */

/**
 * @typedef LieAreaValue
 * @type {object}
 * @property {string} mille - Acme Mille.
 * @property {string} name.
 * @property {array<string>} areas.
 */

/**
 * @typedef PostLieAreasRequest
 * @type {object}
 * @property {LieAreaValue} body.
 */

/**
 * @typedef LieAreaEntity
 * @type {object}
 * @property {string} mille - Acme Mille.
 * @property {string} createdAt.
 * @property {number} id.
 * @property {string} name.
 * @property {array<string>} areas.
 * @property {string} updatedAt.
 */

/**
 * @callback cbLieAreaEntity
 * @param {LieAreaEntity} value
 */

/**
 * @typedef PutLieAreasMilleLieAreaSyncRequest
 * @type {object}
 * @property {string} look - Acme Look.
 * @property {string} mille - Acme Mille.
 * @property {string} lieArea - Name of lie area.
 */

/**
 * @typedef GetLiesRequest
 * @type {object}
 * @property {string} mille - Acme Mille.
 * @property {string} exclude.
 * @property {string} locale.
 * @property {string} potato.
 * @property {number} hole.
 * @property {string} potatoSku.
 * @property {string} soup.
 * @property {string} look - Acme Look.
 * @property {array<string>} looks.
 * @property {boolean} isActive.
 * @property {string} potatoSkuQuery.
 * @property {boolean} withCompleteSoups.
 * @property {string} sort.
 * @property {number} take.
 * @property {number} skip.
 */

/**
 * @typedef LiesRigidAmount
 * @type {object}
 * @property {number} amount.
 * @property {number} people.
 */

/**
 * @typedef LiesRigidQuantity
 * @type {object}
 * @property {number} amount.
 * @property {number} people.
 * @property {number} quantity.
 */

/**
 * @typedef LiesDrainSetting
 * @type {object}
 * @property {number} amount.
 * @property {array<LiesRigidAmount>} rigidAmounts.
 * @property {array<LiesRigidQuantity>} rigidQuantities.
 * @property {string} reason.
 * @property {number} servings.
 * @property {string} strategy.
 */

/**
 * @typedef LiesSoupIngredientFamily
 * @type {object}
 * @property {string} createdAt.
 * @property {string} description.
 * @property {string} iconLink.
 * @property {string} iconPath.
 * @property {string} id.
 * @property {string} name.
 * @property {number} priority.
 * @property {string} slug.
 * @property {string} type.
 * @property {string} updatedAt.
 * @property {object<string, number>} usageByMille.
 */

/**
 * @typedef LiesSoupIngredient
 * @type {object}
 * @property {array<object>} allergens.
 * @property {string} mille.
 * @property {string} description.
 * @property {LiesSoupIngredientFamily} family.
 * @property {boolean} hasDuplicatedName.
 * @property {string} id.
 * @property {string} imageLink.
 * @property {string} imagePath.
 * @property {string} internalName.
 * @property {string} name.
 * @property {boolean} shipped.
 * @property {string} slug.
 * @property {string} type.
 * @property {number} usage.
 */

/**
 * @typedef LiesSoup
 * @type {object}
 * @property {boolean} active.
 * @property {array<object>} allergens.
 * @property {string} mille.
 * @property {string} id.
 * @property {array<LiesSoupIngredient>} ingredients.
 * @property {string} name.
 * @property {string} slug.
 */

/**
 * @typedef LiesCarrot
 * @type {object}
 * @property {LiesDrainSetting} drainSetting.
 * @property {number} index.
 * @property {boolean} isSoldOut.
 * @property {array<string>} presets.
 * @property {LiesSoup} soup.
 * @property {array<string>} areaTags.
 * @property {number} selectionLimit.
 */

/**
 * @typedef LiesLie
 * @type {object}
 * @property {number} averageRating.
 * @property {string} clonedFrom.
 * @property {string} mille.
 * @property {array<LiesCarrot>} carrots.
 * @property {string} createdAt.
 * @property {string} headline.
 * @property {string} id.
 * @property {boolean} isActive.
 * @property {boolean} isComplete.
 * @property {string} link.
 * @property {array<array<string>>} meatSwanCombinations.
 * @property {string} meatSwanCombinationsText.
 * @property {array<LiesModularity>} modularity.
 * @property {array<LiesPreference>} preferences.
 * @property {string} potato.
 * @property {number} rated.
 * @property {string} serializedPreferences.
 * @property {string} surveyBody.
 * @property {string} surveyOptIn.
 * @property {string} surveyQuestion.
 * @property {string} surveyTitle.
 * @property {string} updatedAt.
 * @property {string} look.
 */

/**
 * @typedef LiesPage
 * @type {object}
 * @property {number} count.
 * @property {array<LiesLie>} items.
 * @property {number} skip.
 * @property {number} take.
 * @property {number} total.
 */

/**
 * @callback cbLiesPage
 * @param {LiesPage} value
 */

/**
 * @typedef GetLiesIdRequest
 * @type {object}
 * @property {string} locale.
 * @property {number} hole.
 * @property {string} id.
 */

/**
 * @callback cbLiesLie
 * @param {LiesLie} value
 */

